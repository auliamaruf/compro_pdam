<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SecurityService
{
    /**
     * Check if IP is blocked or flagged
     */
    public function isIpBlocked($ip): bool
    {
        return Cache::get("ip_blocked:{$ip}", false) || 
               Cache::get("spam_flagged:{$ip}", false);
    }

    /**
     * Check if IP can send emails
     */
    public function canSendEmail($ip): bool
    {
        $key = "email_limit:{$ip}";
        $currentCount = Cache::get($key, 0);
        $maxEmails = config('security.rate_limiting.email_notifications.per_ip_per_hour', 3);
        
        return $currentCount < $maxEmails;
    }

    /**
     * Increment email counter for IP
     */
    public function incrementEmailCounter($ip): void
    {
        $key = "email_limit:{$ip}";
        $currentCount = Cache::get($key, 0);
        Cache::put($key, $currentCount + 1, now()->addHour());
    }

    /**
     * Advanced spam detection
     */
    public function isSpamContent(Request $request): bool
    {
        if (!config('security.spam_detection.enabled', true)) {
            return false;
        }

        $content = strtolower(
            $request->input('message', '') . ' ' . 
            $request->input('subject', '') . ' ' .
            $request->input('description', '')
        );

        // Check spam keywords
        $spamKeywords = config('security.spam_detection.keywords', []);
        foreach ($spamKeywords as $keyword) {
            if (str_contains($content, strtolower($keyword))) {
                $this->logSpamAttempt($request, "Keyword: {$keyword}");
                return true;
            }
        }

        // Check excessive uppercase
        $message = $request->input('message', '') ?: $request->input('description', '');
        if (strlen($message) > 10) {
            $capsRatio = (strlen($message) - strlen(strtolower($message))) / strlen($message);
            $maxCapsRatio = config('security.spam_detection.suspicious_patterns.excessive_caps_ratio', 0.8);
            
            if ($capsRatio > $maxCapsRatio) {
                $this->logSpamAttempt($request, "Excessive caps: {$capsRatio}");
                return true;
            }
        }

        // Check repeated characters
        $repeatedPattern = config('security.spam_detection.suspicious_patterns.repeated_chars', '/(.)\1{4,}/');
        if (preg_match($repeatedPattern, $message)) {
            $this->logSpamAttempt($request, "Repeated characters pattern");
            return true;
        }

        // Check suspicious email pattern
        $email = $request->input('email', '');
        $suspiciousEmailPattern = config('security.spam_detection.suspicious_patterns.suspicious_email', '/[0-9]{5,}@/');
        if (preg_match($suspiciousEmailPattern, $email)) {
            $this->logSpamAttempt($request, "Suspicious email pattern");
            return true;
        }

        // Check for URLs in message (if enabled)
        if (config('security.content_security.block_urls_in_message', true)) {
            if (preg_match('/http[s]?:\/\/|www\.|\.com|\.net|\.org|\.id/i', $content)) {
                $this->logSpamAttempt($request, "URLs in message");
                return true;
            }
        }

        return false;
    }

    /**
     * Flag IP as spam
     */
    public function flagAsSpam($ip, $reason = 'Spam detected'): void
    {
        $blockDuration = config('security.ip_blocking.block_duration_hours', 24);
        Cache::put("spam_flagged:{$ip}", true, now()->addHours($blockDuration));
        
        Log::warning('IP flagged as spam', [
            'ip' => $ip,
            'reason' => $reason,
            'flagged_until' => now()->addHours($blockDuration),
            'timestamp' => now()
        ]);
    }

    /**
     * Block IP for violations
     */
    public function blockIp($ip, $reason = 'Multiple violations'): void
    {
        $blockDuration = config('security.ip_blocking.block_duration_hours', 24);
        Cache::put("ip_blocked:{$ip}", true, now()->addHours($blockDuration));
        
        Log::critical('IP blocked', [
            'ip' => $ip,
            'reason' => $reason,
            'blocked_until' => now()->addHours($blockDuration),
            'timestamp' => now()
        ]);

        // Notify administrators
        $this->notifyAdministrators("IP {$ip} has been blocked for: {$reason}");
    }

    /**
     * Check and increment violation count
     */
    public function checkViolations($ip): bool
    {
        if (!config('security.ip_blocking.enabled', true)) {
            return false;
        }

        $violationKey = "violations:{$ip}";
        $currentViolations = Cache::get($violationKey, 0);
        $maxViolations = config('security.ip_blocking.max_violations', 10);

        $currentViolations++;
        Cache::put($violationKey, $currentViolations, now()->addDay());

        if ($currentViolations >= $maxViolations) {
            $this->blockIp($ip, "Exceeded maximum violations ({$currentViolations})");
            return true;
        }

        return false;
    }

    /**
     * Validate file upload security
     */
    public function validateFileUpload($file): array
    {
        $errors = [];

        // Check file size
        $maxSize = config('security.file_upload.max_size', 2048) * 1024; // Convert to bytes
        if ($file->getSize() > $maxSize) {
            $errors[] = 'File size exceeds maximum allowed size';
        }

        // Check mime type
        $allowedMimes = config('security.file_upload.allowed_mimes', []);
        if (!in_array($file->getClientOriginalExtension(), $allowedMimes)) {
            $errors[] = 'File type not allowed';
        }

        // Check actual mime type
        $allowedMimeTypes = config('security.file_upload.allowed_mimetypes', []);
        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            $errors[] = 'File mime type not allowed';
        }

        // TODO: Add virus scanning if enabled
        if (config('security.file_upload.virus_scan_enabled', false)) {
            // Implement virus scanning integration
        }

        return $errors;
    }

    /**
     * Sanitize filename for secure storage
     */
    public function sanitizeFilename($filename): string
    {
        $info = pathinfo($filename);
        $safeBasename = preg_replace('/[^a-zA-Z0-9\-_]/', '_', $info['filename']);
        $safeExtension = strtolower($info['extension']);
        
        return $safeBasename . '.' . $safeExtension;
    }

    /**
     * Log spam attempt
     */
    private function logSpamAttempt(Request $request, $reason): void
    {
        if (config('security.security_logging.log_spam_attempts', true)) {
            Log::warning('Spam attempt detected', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl(),
                'reason' => $reason,
                'timestamp' => now()
            ]);
        }
    }

    /**
     * Notify administrators of security issues
     */
    private function notifyAdministrators($message): void
    {
        // TODO: Implement email/Slack notifications to administrators
        Log::critical('Security Alert: ' . $message);
    }

    /**
     * Get security statistics
     */
    public function getSecurityStats(): array
    {
        // TODO: Implement security dashboard statistics
        return [
            'blocked_ips_count' => 0,
            'spam_attempts_today' => 0,
            'rate_limit_hits_today' => 0,
        ];
    }
}