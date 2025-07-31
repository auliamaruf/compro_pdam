# 🛡️ Panduan Keamanan - PDAM Website

## 📋 Pendahuluan

Dokumen panduan keamanan komprehensif untuk website PDAM Tirta Perwira Purbalingga. Panduan ini mencakup best practices, konfigurasi keamanan, dan prosedur untuk menjaga keamanan aplikasi dan data.

---

## 🔐 Authentication & Authorization

### 👤 User Authentication

#### Password Policy
```php
// config/app.php - Password requirements
'password_requirements' => [
    'min_length' => 8,
    'require_uppercase' => true,
    'require_lowercase' => true,
    'require_numbers' => true,
    'require_symbols' => true,
    'prevent_common' => true,
    'password_history' => 5,
    'max_age_days' => 90
]
```

#### Two-Factor Authentication (2FA)
```bash
# Install 2FA package
composer require pragmarx/google2fa-laravel

# Enable 2FA for users
php artisan vendor:publish --provider="PragmaRX\Google2FALaravel\ServiceProvider"
```

**Implementation**:
```php
// In User model
use PragmaRX\Google2FALaravel\Facade as Google2FA;

public function enableTwoFactor()
{
    $this->google2fa_secret = Google2FA::generateSecretKey();
    $this->two_factor_enabled = true;
    $this->save();
}
```

#### Session Security
```php
// config/session.php
'lifetime' => 120, // Session timeout (minutes)
'expire_on_close' => true,
'encrypt' => true,
'http_only' => true,
'same_site' => 'lax',
'secure' => env('SESSION_SECURE_COOKIE', true),
```

### 🎭 Role-Based Access Control (RBAC)

#### Permission Matrix
```php
// Using Spatie Permission package
// Database: roles and permissions tables

// Roles creation example:
$superAdmin = Role::create(['name' => 'super_admin']);
$contentManager = Role::create(['name' => 'content_manager']);
$operator = Role::create(['name' => 'operator']);
$viewer = Role::create(['name' => 'viewer']);

// Permissions assignment:
$superAdmin->givePermissionTo([
    'users.*', 'settings.*', 'content.*', 
    'system.*', 'security.*', 'backup.*'
]);

$contentManager->givePermissionTo([
    'content.create', 'content.edit', 'content.delete',
    'media.upload', 'comments.moderate', 'news.publish'
]);

$operator->givePermissionTo([
    'content.view', 'complaints.manage', 'comments.moderate',
    'reports.view', 'tariffs.view'
]);

$viewer->givePermissionTo([
    'content.view', 'reports.view', 'export.data'
]);
```

#### Implementation in Filament
```php
// app/Filament/Resources/BaseResource.php
public static function canViewAny(): bool
{
    return auth()->user()->can('view_any_' . static::getModelName());
}

public static function canCreate(): bool
{
    return auth()->user()->can('create_' . static::getModelName());
}
```

---

## 🛡️ Content Security Policy (CSP)

### 🚫 CSP Headers Configuration

#### Dynamic CSP Middleware
```php
// app/Http/Middleware/SecurityHeadersMiddleware.php
public function handle($request, Closure $next)
{
    $response = $next($request);
    
    // Detect environment and domain
    $protocol = $request->isSecure() ? 'https' : 'http';
    $host = $request->getHost();
    $port = $request->getPort();
    
    $baseUrl = $protocol . '://' . $host;
    if (($protocol === 'http' && $port !== 80) || 
        ($protocol === 'https' && $port !== 443)) {
        $baseUrl .= ':' . $port;
    }
    
    // Build CSP directives
    $csp = $this->buildCspDirectives($baseUrl);
    
    $response->headers->set('Content-Security-Policy', $csp);
    
    return $response;
}

private function buildCspDirectives($baseUrl): string
{
    return implode('; ', [
        "default-src 'self' {$baseUrl}",
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' {$baseUrl} https://cdnjs.cloudflare.com",
        "style-src 'self' 'unsafe-inline' {$baseUrl} https://cdnjs.cloudflare.com https://fonts.googleapis.com",
        "img-src 'self' data: blob: {$baseUrl}",
        "font-src 'self' {$baseUrl} https://fonts.gstatic.com https://cdnjs.cloudflare.com",
        "connect-src 'self' {$baseUrl}",
        "media-src 'self' {$baseUrl}",
        "object-src 'none'",
        "frame-ancestors 'none'",
        "base-uri 'self'",
        "form-action 'self' {$baseUrl}"
    ]);
}
```

#### CSP Testing & Validation
```bash
# Test CSP with online tools
curl -I https://your-domain.com | grep -i content-security-policy

# Validate CSP syntax
https://csp-evaluator.withgoogle.com/
```

### 🔒 Additional Security Headers

#### Complete Security Headers
```php
private function setSecurityHeaders($response, $baseUrl): void
{
    $headers = [
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'DENY',
        'X-XSS-Protection' => '1; mode=block',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Permissions-Policy' => 'camera=(), microphone=(), geolocation=()',
        'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains; preload',
        'Content-Security-Policy' => $this->buildCspDirectives($baseUrl)
    ];
    
    foreach ($headers as $key => $value) {
        $response->headers->set($key, $value);
    }
}
```

---

## 🔍 Input Validation & Sanitization

### ✅ Form Validation

#### Custom Validation Rules
```php
// app/Rules/SafeContent.php
class SafeContent implements Rule
{
    public function passes($attribute, $value)
    {
        // Strip dangerous HTML tags
        $cleanValue = strip_tags($value, '<p><br><strong><em><ul><ol><li><a>');
        
        // Check for script injections
        $dangerousPatterns = [
            '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi',
            '/javascript:/i',
            '/on\w+\s*=/i',
            /<iframe|<object|<embed/i
        ];
        
        foreach ($dangerousPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return false;
            }
        }
        
        return $cleanValue === $value;
    }
    
    public function message()
    {
        return 'The :attribute contains potentially unsafe content.';
    }
}
```

#### Request Validation
```php
// app/Http/Requests/NewsRequest.php
class NewsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255', new SafeContent],
            'content' => ['required', 'string', new SafeContent],
            'slug' => ['required', 'string', 'unique:news,slug,' . $this->id],
            'featured_image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,webp'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'status' => ['required', 'in:draft,published,archived']
        ];
    }
    
    protected function prepareForValidation()
    {
        // Sanitize input before validation
        $this->merge([
            'title' => strip_tags($this->title),
            'slug' => Str::slug($this->title),
            'content' => $this->sanitizeContent($this->content)
        ]);
    }
    
    private function sanitizeContent($content)
    {
        // Use HTMLPurifier for safe HTML cleaning
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($content);
    }
}
```

### 🧹 File Upload Security

#### Secure File Upload Configuration
```php
// config/filesystems.php
'file_upload_security' => [
    'max_file_size' => 2048, // KB
    'allowed_mimes' => [
        'images' => ['jpeg', 'png', 'gif', 'webp', 'svg'],
        'documents' => ['pdf', 'doc', 'docx', 'xls', 'xlsx'],
        'archives' => ['zip', 'rar', '7z']
    ],
    'forbidden_extensions' => [
        'php', 'php3', 'php4', 'php5', 'phtml', 'exe', 
        'bat', 'cmd', 'com', 'pif', 'scr', 'vbs', 'js'
    ],
    'scan_for_viruses' => true,
    'quarantine_suspicious' => true
];
```

#### File Validation Service
```php
// app/Services/FileSecurityService.php
class FileSecurityService
{
    public function validateFile(UploadedFile $file): array
    {
        $errors = [];
        
        // Check file size
        if ($file->getSize() > config('filesystems.file_upload_security.max_file_size') * 1024) {
            $errors[] = 'File size exceeds maximum allowed.';
        }
        
        // Check MIME type
        $allowedMimes = $this->getAllowedMimes();
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            $errors[] = 'File type not allowed.';
        }
        
        // Check file extension
        $extension = strtolower($file->getClientOriginalExtension());
        $forbiddenExtensions = config('filesystems.file_upload_security.forbidden_extensions');
        if (in_array($extension, $forbiddenExtensions)) {
            $errors[] = 'File extension not allowed.';
        }
        
        // Check file content
        if ($this->containsMaliciousContent($file)) {
            $errors[] = 'File contains potentially malicious content.';
        }
        
        return $errors;
    }
    
    private function containsMaliciousContent(UploadedFile $file): bool
    {
        $content = file_get_contents($file->getRealPath());
        
        // Check for PHP code in non-PHP files
        if (strpos($content, '<?php') !== false || strpos($content, '<?=') !== false) {
            return true;
        }
        
        // Check for suspicious patterns
        $maliciousPatterns = [
            '/eval\s*\(/i',
            '/exec\s*\(/i',
            '/system\s*\(/i',
            '/shell_exec\s*\(/i',
            '/base64_decode\s*\(/i'
        ];
        
        foreach ($maliciousPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }
        
        return false;
    }
}
```

---

## 🚨 Attack Prevention

### 🛡️ SQL Injection Prevention

#### Parameterized Queries (Laravel Eloquent)
```php
// ✅ SECURE - Using Eloquent ORM
$users = User::where('email', $email)->where('status', 'active')->get();

// ✅ SECURE - Using Query Builder with bindings
$users = DB::table('users')
    ->where('email', '?')
    ->where('status', '?')
    ->get([$email, 'active']);

// ❌ VULNERABLE - Raw concatenation
$users = DB::select("SELECT * FROM users WHERE email = '{$email}'");

// ✅ SECURE - Raw query with bindings
$users = DB::select('SELECT * FROM users WHERE email = ? AND status = ?', [$email, 'active']);
```

#### Input Sanitization for Raw Queries
```php
// app/Services/DatabaseSecurityService.php
class DatabaseSecurityService
{
    public function sanitizeForDatabase($input): string
    {
        // Remove null bytes
        $input = str_replace(chr(0), '', $input);
        
        // Escape special characters
        $input = addslashes($input);
        
        // Remove SQL keywords (if necessary)
        $sqlKeywords = ['SELECT', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'UNION'];
        foreach ($sqlKeywords as $keyword) {
            $input = str_ireplace($keyword, '', $input);
        }
        
        return $input;
    }
}
```

### 🔓 XSS Prevention

#### Output Escaping
```php
// In Blade templates
{{-- ✅ SECURE - Automatic escaping --}}
<h1>{{ $user->name }}</h1>

{{-- ❌ VULNERABLE - Raw output --}}
<h1>{!! $user->name !!}</h1>

{{-- ✅ SECURE - Controlled raw output with purification --}}
<div>{!! Purify::clean($content) !!}</div>
```

#### Content Sanitization Service
```php
// app/Services/XssProtectionService.php
class XssProtectionService
{
    public function cleanInput($input): string
    {
        // Convert special characters to HTML entities
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        
        // Remove potentially dangerous attributes
        $input = preg_replace('/on\w+="[^"]*"/i', '', $input);
        $input = preg_replace('/javascript:/i', '', $input);
        
        return $input;
    }
    
    public function cleanHtml($html): string
    {
        $config = HTMLPurifier_Config::createDefault();
        
        // Allow only safe HTML tags
        $config->set('HTML.Allowed', 'p,br,strong,em,ul,ol,li,a[href],img[src|alt],h1,h2,h3,h4,h5,h6');
        
        // Remove all JavaScript
        $config->set('HTML.ForbiddenAttributes', 'onclick,onload,onerror,onmouseover');
        
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($html);
    }
}
```

### 🛑 CSRF Protection

#### CSRF Configuration
```php
// config/app.php
'csrf_token_timeout' => 3600, // 1 hour

// In forms
<form method="POST" action="/submit">
    @csrf
    <!-- form fields -->
</form>

// For AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
```

#### Custom CSRF Validation
```php
// app/Http/Middleware/VerifyCsrfToken.php
class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'api/*', // API routes excluded
        'webhook/*' // Webhook routes excluded
    ];
    
    protected function tokensMatch($request)
    {
        $token = $this->getTokenFromRequest($request);
        
        // Log failed CSRF attempts
        if (!hash_equals($request->session()->token(), $token)) {
            Log::warning('CSRF token mismatch', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl()
            ]);
        }
        
        return parent::tokensMatch($request);
    }
}
```

---

## 🔧 Server Security

### 🖥️ Web Server Configuration

#### Apache Security (.htaccess)
```apache
# Prevent access to sensitive files
<Files ~ "^\.">
    Order allow,deny
    Deny from all
</Files>

<Files ~ "(\.env|composer\.(json|lock)|package\.(json|lock))$">
    Order allow,deny
    Deny from all
</Files>

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Referrer-Policy "strict-origin-when-cross-origin"

# Disable server signature
ServerTokens Prod
ServerSignature Off

# Prevent access to PHP files in uploads
<Directory "/path/to/public/uploads">
    <Files "*.php">
        Order allow,deny
        Deny from all
    </Files>
</Directory>
```

#### Nginx Security Configuration
```nginx
# /etc/nginx/sites-available/pdam-website
server {
    # Hide Nginx version
    server_tokens off;
    
    # Security headers
    add_header X-Content-Type-Options nosniff;
    add_header X-Frame-Options DENY;
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy "strict-origin-when-cross-origin";
    add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline';";
    
    # Prevent access to sensitive files
    location ~ /\. {
        deny all;
        access_log off;
        log_not_found off;
    }
    
    location ~ \.(env|composer\.(json|lock)|package\.(json|lock))$ {
        deny all;
        access_log off;
        log_not_found off;
    }
    
    # Prevent PHP execution in uploads
    location ~* ^/uploads/.*\.(php|php3|php4|php5|phtml)$ {
        deny all;
    }
    
    # Rate limiting
    limit_req_zone $binary_remote_addr zone=login:10m rate=5r/m;
    
    location /admin {
        limit_req zone=login burst=5 nodelay;
        try_files $uri $uri/ /index.php?$query_string;
    }
}
```

### 🔐 PHP Security Configuration

#### Secure php.ini Settings
```ini
; Hide PHP version
expose_php = Off

; Disable dangerous functions
disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source

; File upload security
file_uploads = On
upload_max_filesize = 2M
max_file_uploads = 20
post_max_size = 8M

; Session security
session.cookie_httponly = 1
session.cookie_secure = 1
session.use_strict_mode = 1
session.cookie_samesite = "Strict"

; Error handling
display_errors = Off
log_errors = On
error_log = /var/log/php/error.log

; Memory limits
memory_limit = 256M
max_execution_time = 30
max_input_time = 60
```

---

## 📊 Security Monitoring

### 🔍 Activity Logging

#### Comprehensive Activity Logger
```php
// app/Services/SecurityLogger.php
class SecurityLogger
{
    public function logUserAction($user, $action, $details = [])
    {
        activity()
            ->performedOn($user)
            ->log($action)
            ->withProperties([
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'url' => request()->fullUrl(),
                'details' => $details,
                'timestamp' => now(),
                'session_id' => session()->getId()
            ]);
    }
    
    public function logSecurityEvent($event, $severity = 'medium', $details = [])
    {
        Log::channel('security')->warning($event, [
            'severity' => $severity,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'details' => $details,
            'timestamp' => now()
        ]);
        
        // Send alert for high severity events
        if ($severity === 'high') {
            $this->sendSecurityAlert($event, $details);
        }
    }
    
    private function sendSecurityAlert($event, $details)
    {
        // Email alert to administrators
        Mail::to(config('security.alert_emails'))
            ->send(new SecurityAlertMail($event, $details));
    }
}
```

#### Failed Login Attempt Tracking
```php
// app/Http/Controllers/Auth/LoginController.php
class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        
        if (!Auth::attempt($credentials, $request->filled('remember'))) {
            // Log failed attempt
            $this->logFailedLogin($request, $credentials['email']);
            
            // Check for brute force
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                $this->sendLockoutResponse($request);
            }
            
            return false;
        }
        
        // Clear failed attempts on successful login
        $this->clearLoginAttempts($request);
        return true;
    }
    
    private function logFailedLogin($request, $email)
    {
        $securityLogger = app(SecurityLogger::class);
        $securityLogger->logSecurityEvent('Failed login attempt', 'medium', [
            'email' => $email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
    }
}
```

### 🚨 Intrusion Detection

#### Suspicious Activity Detection
```php
// app/Services/IntrusionDetectionService.php
class IntrusionDetectionService
{
    protected $suspiciousPatterns = [
        'sql_injection' => [
            '/union\s+select/i',
            '/drop\s+table/i',
            '/insert\s+into/i',
            '/delete\s+from/i'
        ],
        'xss_attempts' => [
            '/<script/i',
            '/javascript:/i',
            '/on\w+\s*=/i'
        ],
        'file_inclusion' => [
            '/\.\.\//i',
            '/etc\/passwd/i',
            '/proc\/self\/environ/i'
        ]
    ];
    
    public function analyzeRequest(Request $request): array
    {
        $threats = [];
        $allInput = array_merge(
            $request->all(),
            [$request->getRequestUri()],
            $request->headers->all()
        );
        
        foreach ($allInput as $key => $value) {
            if (is_string($value)) {
                $threats = array_merge($threats, $this->scanForThreats($key, $value));
            }
        }
        
        if (!empty($threats)) {
            $this->handleThreatDetection($request, $threats);
        }
        
        return $threats;
    }
    
    private function scanForThreats($field, $value): array
    {
        $detectedThreats = [];
        
        foreach ($this->suspiciousPatterns as $threatType => $patterns) {
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $value)) {
                    $detectedThreats[] = [
                        'type' => $threatType,
                        'field' => $field,
                        'pattern' => $pattern,
                        'value' => substr($value, 0, 100) // Truncate for logging
                    ];
                }
            }
        }
        
        return $detectedThreats;
    }
    
    private function handleThreatDetection(Request $request, array $threats)
    {
        $securityLogger = app(SecurityLogger::class);
        
        foreach ($threats as $threat) {
            $securityLogger->logSecurityEvent(
                'Potential attack detected: ' . $threat['type'],
                'high',
                [
                    'threat_details' => $threat,
                    'full_request' => [
                        'url' => $request->fullUrl(),
                        'method' => $request->method(),
                        'ip' => $request->ip(),
                        'user_agent' => $request->userAgent()
                    ]
                ]
            );
        }
        
        // Block request if too many threats detected
        if (count($threats) > 3) {
            abort(403, 'Suspicious activity detected');
        }
    }
}
```

---

## 🔄 Backup & Recovery

### 💾 Automated Backup System

#### Database Backup Configuration
```php
// config/backup.php
return [
    'backup' => [
        'name' => env('APP_NAME', 'pdam-website'),
        'source' => [
            'files' => [
                'include' => [
                    base_path(),
                ],
                'exclude' => [
                    base_path('vendor'),
                    base_path('node_modules'),
                    base_path('storage/logs'),
                    base_path('storage/framework/cache'),
                ],
                'follow_links' => false,
                'ignore_unreadable_directories' => false,
                'relative_path' => null,
            ],
            'databases' => [
                'mysql',
            ],
        ],
        'destination' => [
            'filename_prefix' => '',
            'disks' => [
                'backup',
                's3', // Remote backup
            ],
        ],
        'temporary_directory' => storage_path('app/backup-temp'),
    ],
    
    'notifications' => [
        'notifications' => [
            \Spatie\Backup\Notifications\Notifications\BackupHasFailed::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\UnhealthyBackupWasFound::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\CleanupHasFailed::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\BackupWasSuccessful::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\HealthyBackupWasFound::class => ['mail'],
            \Spatie\Backup\Notifications\Notifications\CleanupWasSuccessful::class => ['mail'],
        ],
        'mail' => [
            'to' => env('BACKUP_NOTIFICATION_EMAIL', 'admin@pdampurbalingga.co.id'),
            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'backup@pdampurbalingga.co.id'),
                'name' => env('MAIL_FROM_NAME', 'PDAM Backup System'),
            ],
        ],
    ],
    
    'monitor_backups' => [
        [
            'name' => env('APP_NAME', 'pdam-website'),
            'disks' => ['backup'],
            'health_checks' => [
                \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumAgeInDays::class => 1,
                \Spatie\Backup\Tasks\Monitor\HealthChecks\MaximumStorageInMegabytes::class => 5000,
            ],
        ],
    ],
    
    'cleanup' => [
        'strategy' => \Spatie\Backup\Tasks\Cleanup\Strategies\DefaultStrategy::class,
        'default_strategy' => [
            'keep_all_backups_for_days' => 7,
            'keep_daily_backups_for_days' => 16,
            'keep_weekly_backups_for_weeks' => 8,
            'keep_monthly_backups_for_months' => 4,
            'keep_yearly_backups_for_years' => 2,
            'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
        ],
    ],
];
```

#### Backup Scheduler
```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    // Daily full backup at 2 AM
    $schedule->command('backup:run')
        ->daily()
        ->at('02:00')
        ->emailOutputOnFailure(config('backup.notifications.mail.to'));
    
    // Database-only backup every 6 hours
    $schedule->command('backup:run --only-db')
        ->everySixHours()
        ->emailOutputOnFailure(config('backup.notifications.mail.to'));
    
    // Cleanup old backups weekly
    $schedule->command('backup:clean')
        ->weekly()
        ->sundays()
        ->at('03:00');
    
    // Monitor backup health daily
    $schedule->command('backup:monitor')
        ->daily()
        ->at('04:00');
}
```

### 🔄 Disaster Recovery Plan

#### Recovery Procedures
```bash
#!/bin/bash
# disaster-recovery.sh

echo "PDAM Website Disaster Recovery - Starting..."

# 1. Database Recovery
echo "Restoring database..."
mysql -u $DB_USER -p$DB_PASS $DB_NAME < backup/database-backup-$(date +%Y%m%d).sql

# 2. File Recovery
echo "Restoring application files..."
rsync -av backup/files/ /path/to/application/

# 3. Storage Recovery
echo "Restoring storage files..."
rsync -av backup/storage/ storage/

# 4. Clear caches
echo "Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 5. Regenerate application key
echo "Regenerating application key..."
php artisan key:generate --force

# 6. Run migrations (if needed)
echo "Running database migrations..."
php artisan migrate --force

# 7. Set proper permissions
echo "Setting file permissions..."
chown -R www-data:www-data /path/to/application/
chmod -R 755 /path/to/application/
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# 8. Test application
echo "Testing application..."
php artisan optimize
php artisan storage:link

echo "Disaster recovery completed!"
```

---

## 📋 Security Checklist

### ✅ Daily Security Tasks

#### Automated Security Checks
```php
// app/Console/Commands/SecurityCheck.php
class SecurityCheck extends Command
{
    protected $signature = 'security:check';
    protected $description = 'Run daily security checks';
    
    public function handle()
    {
        $this->info('Running security checks...');
        
        // Check for suspicious files
        $this->checkSuspiciousFiles();
        
        // Check file permissions
        $this->checkFilePermissions();
        
        // Check for outdated packages
        $this->checkPackageUpdates();
        
        // Check failed login attempts
        $this->checkFailedLogins();
        
        // Check disk space
        $this->checkDiskSpace();
        
        $this->info('Security check completed!');
    }
    
    private function checkSuspiciousFiles()
    {
        $suspicious = [
            '*.php.suspected',
            '*.php.bak',
            '*.php~',
            'shell.php',
            'c99.php',
            'r57.php'
        ];
        
        foreach ($suspicious as $pattern) {
            $files = glob(base_path($pattern));
            if (!empty($files)) {
                $this->error("Suspicious files found: " . implode(', ', $files));
            }
        }
    }
    
    private function checkFilePermissions()
    {
        $criticalFiles = [
            '.env' => '600',
            'config/' => '755',
            'storage/' => '775',
            'bootstrap/cache/' => '775'
        ];
        
        foreach ($criticalFiles as $file => $expectedPerm) {
            $path = base_path($file);
            if (file_exists($path)) {
                $currentPerm = substr(sprintf('%o', fileperms($path)), -3);
                if ($currentPerm !== $expectedPerm) {
                    $this->warn("File {$file} has permissions {$currentPerm}, expected {$expectedPerm}");
                }
            }
        }
    }
}
```

### 🔄 Weekly Security Tasks

#### Security Audit Script
```bash
#!/bin/bash
# weekly-security-audit.sh

echo "=== PDAM Website Weekly Security Audit ==="
echo "Date: $(date)"
echo

# 1. Check for package updates
echo "1. Checking for package updates..."
composer outdated --direct

# 2. Check log files for suspicious activity
echo "2. Analyzing log files..."
grep -i "failed login\|suspicious\|attack\|injection" storage/logs/*.log | tail -20

# 3. Check file integrity
echo "3. Checking file integrity..."
find . -name "*.php" -type f -exec grep -l "eval\|base64_decode\|system\|exec" {} \; | head -10

# 4. Database security check
echo "4. Database security check..."
php artisan security:db-check

# 5. Check SSL certificate
echo "5. SSL certificate check..."
openssl s_client -connect your-domain.com:443 -servername your-domain.com < /dev/null 2>/dev/null | openssl x509 -noout -dates

# 6. Backup verification
echo "6. Backup verification..."
php artisan backup:list

echo
echo "=== Security Audit Completed ==="
```

### 📊 Security Metrics

#### Security Dashboard
```php
// app/Filament/Widgets/SecurityOverview.php
class SecurityOverview extends BaseWidget
{
    protected static string $view = 'filament.widgets.security-overview';
    
    public function getViewData(): array
    {
        return [
            'failed_logins_today' => $this->getFailedLoginsToday(),
            'active_sessions' => $this->getActiveSessions(),
            'last_backup' => $this->getLastBackupDate(),
            'security_alerts' => $this->getSecurityAlerts(),
            'ssl_status' => $this->getSslStatus(),
            'package_vulnerabilities' => $this->getPackageVulnerabilities()
        ];
    }
    
    private function getFailedLoginsToday(): int
    {
        return DB::table('activity_log')
            ->where('description', 'Failed login attempt')
            ->whereDate('created_at', today())
            ->count();
    }
    
    private function getActiveSessions(): int
    {
        return DB::table('sessions')
            ->where('last_activity', '>', now()->subMinutes(30)->timestamp)
            ->count();
    }
    
    private function getSecurityAlerts(): array
    {
        return DB::table('activity_log')
            ->where('description', 'like', '%attack%')
            ->orWhere('description', 'like', '%suspicious%')
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->toArray();
    }
}
```

---

## 📞 Incident Response

### 🚨 Security Incident Procedures

#### Incident Response Plan
```php
// app/Services/IncidentResponseService.php
class IncidentResponseService
{
    const SEVERITY_LOW = 'low';
    const SEVERITY_MEDIUM = 'medium';
    const SEVERITY_HIGH = 'high';
    const SEVERITY_CRITICAL = 'critical';
    
    public function handleSecurityIncident($incident, $severity = self::SEVERITY_MEDIUM)
    {
        // 1. Log the incident
        $this->logIncident($incident, $severity);
        
        // 2. Assess the threat
        $threatLevel = $this->assessThreat($incident, $severity);
        
        // 3. Take immediate action
        $this->takeImmediateAction($incident, $threatLevel);
        
        // 4. Notify stakeholders
        $this->notifyStakeholders($incident, $severity);
        
        // 5. Document the incident
        $this->documentIncident($incident, $severity);
    }
    
    private function takeImmediateAction($incident, $threatLevel)
    {
        switch ($threatLevel) {
            case 'critical':
                // Block all external access
                $this->enableMaintenanceMode();
                $this->blockSuspiciousIPs($incident);
                $this->alertAllAdministrators($incident);
                break;
                
            case 'high':
                // Block suspicious IPs
                $this->blockSuspiciousIPs($incident);
                $this->increaseSecurityLevel();
                break;
                
            case 'medium':
                // Monitor closely
                $this->enhanceMonitoring();
                $this->logAdditionalDetails($incident);
                break;
        }
    }
    
    private function blockSuspiciousIPs($incident)
    {
        $ips = $this->extractIPsFromIncident($incident);
        
        foreach ($ips as $ip) {
            // Add to firewall block list
            Cache::put("blocked_ip_{$ip}", true, now()->addHours(24));
            
            // Log the blocking action
            Log::warning("IP {$ip} blocked due to security incident");
        }
    }
}
```

#### Emergency Contacts
```php
// config/security.php
return [
    'emergency_contacts' => [
        'primary_admin' => 'admin@pdampurbalingga.co.id',
        'technical_lead' => 'tech@pdampurbalingga.co.id',
        'director' => 'director@pdampurbalingga.co.id',
        'hosting_provider' => 'support@hostingprovider.com'
    ],
    
    'incident_response_team' => [
        'team_lead' => 'security@pdampurbalingga.co.id',
        'technical_support' => 'tech-support@pdampurbalingga.co.id',
        'communication_lead' => 'pr@pdampurbalingga.co.id'
    ],
    
    'escalation_matrix' => [
        'low' => ['technical_support'],
        'medium' => ['technical_support', 'team_lead'],
        'high' => ['team_lead', 'primary_admin', 'technical_lead'],
        'critical' => 'all' // All contacts
    ]
];
```

---

## 📚 Security Training

### 👨‍🏫 Security Awareness

#### Admin Training Checklist
- [ ] **Password Security**: Strong passwords, 2FA setup
- [ ] **Phishing Recognition**: Identifying suspicious emails
- [ ] **Safe Browsing**: Avoiding malicious websites
- [ ] **File Upload Safety**: Validating file types and content
- [ ] **Social Engineering**: Recognizing manipulation attempts
- [ ] **Incident Reporting**: How to report security issues
- [ ] **Data Protection**: Handling sensitive information

#### Monthly Security Reminders
```php
// app/Console/Commands/SecurityReminder.php
class SecurityReminder extends Command
{
    protected $signature = 'security:reminder';
    
    public function handle()
    {
        $admins = User::where('role', 'super_admin')->get();
        
        $reminders = [
            'Update your passwords if they\'re older than 90 days',
            'Review recent login activity for suspicious access',
            'Check for software updates and security patches',
            'Verify backup integrity and test recovery procedures',
            'Review user access permissions and roles',
            'Monitor security logs for unusual activity'
        ];
        
        $thisMonthReminder = $reminders[date('n') - 1] ?? $reminders[0];
        
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new SecurityReminderMail($thisMonthReminder));
        }
    }
}
```

---

**Last Updated**: January 31, 2025  
**Document Version**: 1.0  
**Security Framework**: Laravel Security Best Practices
