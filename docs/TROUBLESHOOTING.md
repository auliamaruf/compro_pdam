# 🔧 Troubleshooting Guide - PDAM Website

## 📋 Pendahuluan

Panduan lengkap untuk mendiagnosis dan mengatasi masalah umum yang mungkin terjadi pada website PDAM Tirta Perwira Purbalingga. Dokumen ini mencakup troubleshooting untuk berbagai aspek sistem mulai dari deployment hingga operasional harian.

---

## 🚨 Emergency Procedures

### 🆘 Website Down - Immediate Response

#### Quick Health Check
```bash
# Check if website is responding
curl -I https://pdampurbalingga.co.id

# Check server resources
df -h                    # Disk space
free -m                  # Memory usage
top                      # CPU usage
systemctl status nginx   # Web server status
systemctl status php8.2-fpm  # PHP status
systemctl status mysql  # Database status
```

#### Emergency Recovery Steps
```bash
# 1. Enable maintenance mode
php artisan down --message="Website sedang dalam maintenance"

# 2. Check error logs
tail -f storage/logs/laravel.log
tail -f /var/log/nginx/error.log

# 3. Quick fixes
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Restart services if needed
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm

# 5. Disable maintenance mode
php artisan up
```

#### Emergency Contacts
```
Primary Admin: admin@pdampurbalingga.co.id
Technical Lead: tech@pdampurbalingga.co.id
Hosting Provider: support@hostingprovider.com
Emergency Phone: +62 281 891234
```

---

## 🔍 Common Issues

### 💻 Application Issues

#### Issue: "500 Internal Server Error"

**Symptoms:**
- White screen with 500 error
- Users cannot access website
- Error appears in browser

**Diagnosis:**
```bash
# Check Laravel logs
tail -100 storage/logs/laravel.log

# Check web server logs
tail -100 /var/log/nginx/error.log

# Check PHP-FPM logs
tail -100 /var/log/php8.2-fpm.log
```

**Common Causes & Solutions:**

1. **Permission Issues**
```bash
# Fix file permissions
sudo chown -R www-data:www-data /path/to/website/
sudo chmod -R 755 /path/to/website/
sudo chmod -R 775 storage/
sudo chmod -R 775 bootstrap/cache/
```

2. **Missing Environment File**
```bash
# Check if .env exists
ls -la .env

# If missing, copy from example
cp .env.example .env
php artisan key:generate
```

3. **Database Connection Issues**
```bash
# Test database connection
php artisan tinker
> DB::connection()->getPdo();

# Check database credentials in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pdam_database
DB_USERNAME=pdam_user
DB_PASSWORD=secure_password
```

4. **Memory Limit Exceeded**
```bash
# Check PHP memory limit
php -i | grep memory_limit

# Increase memory limit in php.ini
memory_limit = 512M

# Restart PHP-FPM
sudo systemctl restart php8.2-fpm
```

#### Issue: "Class Not Found" Errors

**Symptoms:**
- Fatal error: Class 'ClassName' not found
- Composer autoload issues

**Solutions:**
```bash
# Regenerate autoload files
composer dump-autoload

# Clear compiled classes
php artisan clear-compiled

# Optimize autoloader
composer dump-autoload --optimize
```

#### Issue: "CSRF Token Mismatch"

**Symptoms:**
- 419 error on form submissions
- "CSRF token mismatch" message

**Solutions:**
```bash
# Clear sessions
php artisan session:clear

# Check session configuration
# config/session.php
'domain' => env('SESSION_DOMAIN', null),
'secure' => env('SESSION_SECURE_COOKIE', false),

# For HTTPS sites, set in .env:
SESSION_SECURE_COOKIE=true
```

### 🖼️ Media & File Issues

#### Issue: Images Not Displaying

**Symptoms:**
- Broken image icons
- Images not loading on frontend
- Media library issues

**Diagnosis:**
```bash
# Check storage link
ls -la public/storage

# Check file permissions
ls -la storage/app/public/

# Check disk space
df -h
```

**Solutions:**
```bash
# Recreate storage link
php artisan storage:link

# Fix media library permissions
sudo chmod -R 775 storage/app/public/
sudo chown -R www-data:www-data storage/app/public/

# Clear media cache
php artisan media-library:clear

# If using Spatie Media Library
php artisan media-library:regenerate
```

#### Issue: File Upload Failures

**Symptoms:**
- Upload progress bar stops
- "File too large" errors
- Upload timeouts

**Solutions:**
```bash
# Check PHP upload limits
php -i | grep -E "(upload_max_filesize|post_max_size|max_execution_time)"

# Update php.ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
max_input_time = 300

# Check Nginx limits (if using Nginx)
client_max_body_size 10M;

# Restart services
sudo systemctl restart php8.2-fpm
sudo systemctl restart nginx
```

### 🗄️ Database Issues

#### Issue: "Access Denied" Database Errors

**Symptoms:**
- Cannot connect to database
- Authentication failures
- Database connection refused

**Diagnosis:**
```bash
# Test MySQL connection
mysql -u username -p -h localhost database_name

# Check MySQL service
systemctl status mysql

# Check MySQL error logs
tail -100 /var/log/mysql/error.log
```

**Solutions:**
```bash
# Reset MySQL user permissions
mysql -u root -p
> GRANT ALL PRIVILEGES ON pdam_database.* TO 'pdam_user'@'localhost';
> FLUSH PRIVILEGES;

# Update .env with correct credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pdam_database
DB_USERNAME=pdam_user
DB_PASSWORD=correct_password

# Test connection
php artisan migrate:status
```

#### Issue: Migration Failures

**Symptoms:**
- Migration rollback errors
- Schema update failures
- Foreign key constraint issues

**Solutions:**
```bash
# Check migration status
php artisan migrate:status

# Force run problematic migration
php artisan migrate --force

# Rollback and retry
php artisan migrate:rollback
php artisan migrate

# Fresh migration (WARNING: Data loss)
php artisan migrate:fresh --seed
```

### 🔐 Authentication Issues

#### Issue: Cannot Access Admin Panel

**Symptoms:**
- Login page not working
- Credentials not accepted
- Redirect loops

**Solutions:**
```bash
# Create new admin user
php artisan make:filament-user

# Reset existing user password
php artisan tinker
> $user = App\Models\User::where('email', 'admin@example.com')->first();
> $user->password = Hash::make('new_password');
> $user->save();

# Clear auth sessions
php artisan session:clear
```

#### Issue: "User Role Not Found"

**Symptoms:**
- Permission denied errors
- Role assignment issues

**Solutions:**
```bash
# Check user roles in database using Spatie Permission
php artisan tinker
> App\Models\User::with('roles')->get();

# Assign role to user using Spatie Permission
> $user = App\Models\User::find(1);
> $user->assignRole('super_admin');

# Check user permissions
> $user->getAllPermissions();

# Create missing roles
> Spatie\Permission\Models\Role::create(['name' => 'super_admin']);
> Spatie\Permission\Models\Role::create(['name' => 'content_manager']);
```

---

## 🌐 Performance Issues

### 🐌 Slow Website Response

#### Issue: High Page Load Times

**Diagnosis:**
```bash
# Check server resources
htop                     # CPU and memory usage
iotop                    # Disk I/O
netstat -tuln           # Network connections

# Laravel debugging
php artisan route:list   # Check for N+1 queries
php artisan telescope:list  # If Telescope installed
```

**Solutions:**

1. **Enable Caching**
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Enable OPcache in php.ini
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
```

2. **Database Optimization**
```bash
# Optimize database
php artisan db:optimize

# Add database indexes
php artisan make:migration add_indexes_to_news_table
```

3. **Image Optimization**
```bash
# Install image optimization tools
sudo apt install jpegoptim optipng pngquant gifsicle

# Optimize existing images
find storage/app/public -name "*.jpg" -exec jpegoptim --max=85 {} \;
find storage/app/public -name "*.png" -exec optipng -o2 {} \;
```

#### Issue: High Memory Usage

**Symptoms:**
- Server running out of memory
- 500 errors during peak traffic
- Slow response times

**Solutions:**
```bash
# Increase PHP memory limit
# php.ini
memory_limit = 512M

# Add swap space
sudo fallocate -l 2G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile

# Optimize Laravel for memory usage
php artisan optimize
php artisan config:cache
php artisan route:cache
```

### 📊 Database Performance

#### Issue: Slow Database Queries

**Diagnosis:**
```bash
# Enable MySQL slow query log
# /etc/mysql/mysql.conf.d/mysqld.cnf
slow_query_log = 1
slow_query_log_file = /var/log/mysql/slow.log
long_query_time = 2

# Analyze slow queries
mysqldumpslow /var/log/mysql/slow.log
```

**Solutions:**
```bash
# Add missing indexes
php artisan make:migration add_index_to_news_title
# In migration:
$table->index('title');
$table->index(['status', 'published_at']);

# Optimize queries in models
// Use eager loading
News::with('author', 'categories')->get();

// Use select to limit columns
News::select('id', 'title', 'slug')->get();
```

---

## 🔒 Security Issues

### 🛡️ Security Vulnerabilities

#### Issue: Suspicious Activity Detected

**Symptoms:**
- Multiple failed login attempts
- Unusual traffic patterns
- Security alerts in logs

**Immediate Actions:**
```bash
# Check failed login attempts
grep "Failed login" storage/logs/laravel.log | tail -20

# Block suspicious IPs (temporarily)
sudo iptables -A INPUT -s SUSPICIOUS_IP -j DROP

# Enable maintenance mode
php artisan down --secret="emergency-access-token"

# Review security logs
tail -100 /var/log/auth.log
tail -100 /var/log/fail2ban.log
```

**Long-term Solutions:**
```bash
# Install fail2ban
sudo apt install fail2ban

# Configure fail2ban for Laravel
# /etc/fail2ban/jail.local
[laravel]
enabled = true
filter = laravel
logpath = /path/to/laravel/storage/logs/laravel.log
maxretry = 3
bantime = 3600
```

#### Issue: Malware or Unauthorized Files

**Symptoms:**
- Unknown PHP files in directories
- Suspicious code injections
- Modified core files

**Detection & Cleanup:**
```bash
# Scan for suspicious PHP files
find . -name "*.php" -type f -exec grep -l "eval\|base64_decode\|system\|exec" {} \;

# Check for unusual files
find . -name "*.php" -newer /path/to/last_known_good_backup -ls

# Restore from clean backup
rsync -av /path/to/clean/backup/ ./

# Update file permissions
sudo chown -R www-data:www-data ./
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod 775 storage/ bootstrap/cache/
```

### 🔐 SSL/TLS Issues

#### Issue: SSL Certificate Problems

**Symptoms:**
- "Not secure" warning in browser
- SSL certificate expired
- Mixed content warnings

**Solutions:**
```bash
# Check SSL certificate status
openssl s_client -connect yourdomain.com:443 -servername yourdomain.com

# Renew Let's Encrypt certificate
sudo certbot renew

# Force HTTPS in Laravel
# app/Providers/AppServiceProvider.php
public function boot()
{
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
}

# Fix mixed content
# Update .env
APP_URL=https://yourdomain.com
ASSET_URL=https://yourdomain.com
```

---

## 📧 Email Issues

### 📮 Email Delivery Problems

#### Issue: Emails Not Sending

**Symptoms:**
- Contact form submissions not received
- Password reset emails not delivered
- No email notifications

**Diagnosis:**
```bash
# Check mail configuration
php artisan tinker
> Mail::raw('Test message', function($message) {
    $message->to('test@example.com')->subject('Test');
});

# Check mail logs
tail -100 /var/log/mail.log

# Test SMTP connection
telnet smtp.gmail.com 587
```

**Solutions:**
```bash
# Configure SMTP in .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls

# Use queue for email sending
QUEUE_CONNECTION=database
php artisan queue:work

# Clear mail configuration cache
php artisan config:clear
```

#### Issue: Emails Going to Spam

**Solutions:**
```bash
# Configure SPF record in DNS
"v=spf1 include:_spf.google.com ~all"

# Configure DKIM
# Add DKIM key to DNS records

# Configure DMARC
"v=DMARC1; p=quarantine; rua=mailto:dmarc@yourdomain.com"

# Use proper from address
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="PDAM Tirta Perwira"
```

---

## 🚀 Deployment Issues

### 📦 aaPanel Deployment Problems

#### Issue: Deployment Script Failures

**Symptoms:**
- Deployment script stops with errors
- Files not uploaded correctly
- Services not restarting

**Solutions:**
```bash
# Manual deployment steps
cd /www/wwwroot/yourdomain.com

# Update code
git pull origin main

# Install/update dependencies
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Run migrations
php artisan migrate --force

# Clear caches
php artisan optimize:clear
php artisan optimize

# Fix permissions
chown -R www:www ./
chmod -R 755 ./
chmod -R 775 storage/ bootstrap/cache/

# Restart services
systemctl restart nginx
systemctl restart php8.2-fpm
```

#### Issue: File Permission Problems

**Symptoms:**
- Cannot write to storage directory
- Cache errors
- Session storage issues

**Solutions:**
```bash
# Set correct ownership
chown -R www:www /www/wwwroot/yourdomain.com/

# Set correct permissions
find /www/wwwroot/yourdomain.com/ -type f -exec chmod 644 {} \;
find /www/wwwroot/yourdomain.com/ -type d -exec chmod 755 {} \;

# Special permissions for Laravel
chmod -R 775 /www/wwwroot/yourdomain.com/storage/
chmod -R 775 /www/wwwroot/yourdomain.com/bootstrap/cache/

# Create storage link
cd /www/wwwroot/yourdomain.com/
php artisan storage:link
```

### 🔄 Git Deployment Issues

#### Issue: Git Pull Conflicts

**Symptoms:**
- Cannot pull latest changes
- Merge conflicts in deployment
- Files stuck in conflict state

**Solutions:**
```bash
# Force pull (WARNING: Loses local changes)
git fetch origin
git reset --hard origin/main

# Resolve conflicts manually
git status                    # Check conflicted files
git add conflicted_file.php   # After manual resolution
git commit -m "Resolve deployment conflicts"

# Use deployment-safe approach
git stash                     # Save local changes
git pull origin main          # Pull updates
git stash pop                 # Restore local changes if needed
```

---

## 📱 Frontend Issues

### 🎨 CSS/JavaScript Problems

#### Issue: Styles Not Loading

**Symptoms:**
- Website appears unstyled
- CSS not loading in browser
- JavaScript functionality broken

**Solutions:**
```bash
# Rebuild assets
npm run build

# Clear browser cache
# Add cache busting to vite.config.js
export default defineConfig({
    build: {
        rollupOptions: {
            output: {
                entryFileNames: `assets/[name].[hash].js`,
                chunkFileNames: `assets/[name].[hash].js`,
                assetFileNames: `assets/[name].[hash].[ext]`
            }
        }
    }
});

# Check asset URLs in .env
ASSET_URL=https://yourdomain.com

# Verify file permissions
ls -la public/build/
```

#### Issue: JavaScript Errors

**Diagnosis:**
```javascript
// Check browser console for errors
// Common issues:
// - Uncaught ReferenceError
// - Module not found
// - CORS errors
```

**Solutions:**
```bash
# Rebuild JavaScript
npm run dev    # Development
npm run build  # Production

# Check for syntax errors
npm run lint

# Update dependencies
npm update

# Clear Node modules and reinstall
rm -rf node_modules package-lock.json
npm install
```

---

## 🔧 System Administration

### 💽 Server Maintenance

#### Issue: Disk Space Full

**Symptoms:**
- Cannot write files
- Error logs mention "No space left on device"
- Website functionality breaks

**Solutions:**
```bash
# Check disk usage
df -h
du -sh /var/log/*
du -sh storage/logs/*

# Clean Laravel logs
php artisan log:clear

# Clean system logs
sudo journalctl --vacuum-time=7d

# Clean old backups
find backups/ -type f -mtime +30 -delete

# Clean cache files
php artisan cache:clear
rm -rf storage/framework/cache/data/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*
```

#### Issue: High CPU Usage

**Diagnosis:**
```bash
# Check running processes
top -c
htop

# Check for runaway processes
ps aux | sort -nrk 3,3 | head -5

# Check for queue workers
ps aux | grep "queue:work"
```

**Solutions:**
```bash
# Restart queue workers
php artisan queue:restart

# Optimize autoloader
composer dump-autoload --optimize

# Enable OPcache
# php.ini
opcache.enable=1
opcache.memory_consumption=256

# Kill problematic processes
sudo kill -9 PROCESS_ID
```

---

## 📋 Monitoring & Logging

### 📊 Log Analysis

#### Important Log Locations
```bash
# Laravel application logs
storage/logs/laravel.log

# Web server logs
/var/log/nginx/access.log
/var/log/nginx/error.log

# PHP logs
/var/log/php8.2-fpm.log

# System logs
/var/log/syslog
/var/log/auth.log

# Database logs
/var/log/mysql/error.log
/var/log/mysql/slow.log
```

#### Log Monitoring Commands
```bash
# Real-time log monitoring
tail -f storage/logs/laravel.log
tail -f /var/log/nginx/error.log

# Search for specific errors
grep "ERROR" storage/logs/laravel.log | tail -20
grep "500" /var/log/nginx/access.log

# Analyze access patterns
awk '{print $1}' /var/log/nginx/access.log | sort | uniq -c | sort -nr | head -10
```

### 🔍 Health Checks

#### Automated Health Check Script
```bash
#!/bin/bash
# health-check.sh

echo "=== PDAM Website Health Check ==="
echo "Timestamp: $(date)"
echo

# Check web server response
echo "1. Website Response:"
curl -Is https://pdampurbalingga.co.id | head -n 1

# Check database connection
echo "2. Database Connection:"
php artisan tinker --execute="DB::connection()->getPdo(); echo 'Database: OK';"

# Check disk space
echo "3. Disk Space:"
df -h | grep -E "(Filesystem|/dev/)"

# Check memory usage
echo "4. Memory Usage:"
free -h

# Check recent errors
echo "5. Recent Errors:"
tail -5 storage/logs/laravel.log | grep ERROR

# Check queue status
echo "6. Queue Status:"
php artisan queue:monitor

echo "=== Health Check Complete ==="
```

---

## 🆘 Emergency Recovery

### 💾 Disaster Recovery

#### Complete System Recovery
```bash
#!/bin/bash
# disaster-recovery.sh

echo "=== EMERGENCY RECOVERY PROCEDURE ==="
echo "WARNING: This will restore from backup"
read -p "Continue? (y/N): " confirm

if [[ $confirm == "y" ]]; then
    # 1. Enable maintenance mode
    php artisan down --message="System recovery in progress"
    
    # 2. Restore database
    mysql -u root -p pdam_database < backup/database-latest.sql
    
    # 3. Restore files
    rsync -av backup/files-latest/ ./
    
    # 4. Set permissions
    chown -R www-data:www-data ./
    chmod -R 755 ./
    chmod -R 775 storage/ bootstrap/cache/
    
    # 5. Clear caches
    php artisan optimize:clear
    php artisan optimize
    
    # 6. Restart services
    systemctl restart nginx php8.2-fpm mysql
    
    # 7. Disable maintenance mode
    php artisan up
    
    echo "Recovery complete!"
else
    echo "Recovery cancelled"
fi
```

#### Backup Verification
```bash
# Test backup integrity
php artisan backup:monitor

# Test database backup
mysql -u root -p test_restore < backup/database-latest.sql

# Verify file backup
tar -tzf backup/files-latest.tar.gz | head -10
```

---

## 📞 Getting Help

### 🔗 Useful Resources

#### Documentation Links
- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [aaPanel Documentation](https://www.aapanel.com/reference.html)
- [Nginx Configuration](https://nginx.org/en/docs/)

#### Community Support
- [Laravel Discord](https://discord.gg/laravel)
- [Filament Discord](https://discord.gg/filamentphp)
- [Stack Overflow Laravel](https://stackoverflow.com/questions/tagged/laravel)

#### Professional Support
```
Primary Contact: tech@pdampurbalingga.co.id
Phone Support: +62 281 891234
Emergency Line: +62 812 3456 7890
Business Hours: Monday-Friday, 08:00-16:00 WIB
```

### 📝 Reporting Issues

#### Issue Report Template
```
**Issue Summary**: Brief description of the problem

**Environment**: 
- Server: Production/Staging/Development
- Time Occurred: YYYY-MM-DD HH:MM:SS
- Affected Users: All/Admin/Specific users

**Steps to Reproduce**:
1. Step one
2. Step two
3. Step three

**Expected Behavior**: What should happen

**Actual Behavior**: What actually happens

**Error Messages**: 
- Browser console errors
- Server log errors
- Error screenshots

**Additional Context**: Any other relevant information

**Attempted Solutions**: What you've already tried
```

---

**Last Updated**: January 31, 2025  
**Document Version**: 1.0  
**Emergency Contact**: tech@pdampurbalingga.co.id
