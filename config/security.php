<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Here you may configure security settings for the application
    |
    */

    // Rate Limiting
    'rate_limiting' => [
        'contact_form' => [
            'attempts' => 3,
            'decay_minutes' => 60,
        ],
        'complaint_form' => [
            'attempts' => 2,
            'decay_minutes' => 60,
        ],
        'api_requests' => [
            'attempts' => 10,
            'decay_minutes' => 1,
        ],
        'email_notifications' => [
            'per_ip_per_hour' => 3,
        ],
    ],

    // Spam Detection
    'spam_detection' => [
        'enabled' => env('SPAM_DETECTION_ENABLED', true),
        
        'keywords' => [
            'viagra', 'casino', 'poker', 'loan', 'debt', 'credit',
            'win money', 'click here', 'free money', 'earn money',
            'make money fast', 'get rich quick', 'lottery winner',
            'casino online', 'judi online', 'pinjaman', 'kredit cepat',
            'togel', 'bandar', 'betting', 'gambling'
        ],
        
        'suspicious_patterns' => [
            'excessive_caps_ratio' => 0.8, // 80% uppercase
            'repeated_chars' => '/(.)\1{4,}/', // 5+ repeated characters
            'suspicious_email' => '/[0-9]{5,}@/', // 5+ numbers in email
        ],
    ],

    // File Upload Security
    'file_upload' => [
        'max_size' => 2048, // KB
        'allowed_mimes' => ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'],
        'allowed_mimetypes' => [
            'image/jpeg',
            'image/png', 
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ],
        'virus_scan_enabled' => env('VIRUS_SCAN_ENABLED', false),
    ],

    // IP Blocking
    'ip_blocking' => [
        'enabled' => env('IP_BLOCKING_ENABLED', true),
        'max_violations' => 10,
        'block_duration_hours' => 24,
    ],

    // Content Security
    'content_security' => [
        'max_message_length' => 2000,
        'block_urls_in_message' => true,
        'honeypot_enabled' => true,
    ],

    // Emergency Contacts
    'emergency_contacts' => [
        'primary_admin' => env('ADMIN_EMAIL', 'admin@pdamtirtaperwira.com'),
        'security_team' => env('SECURITY_EMAIL', 'security@pdamtirtaperwira.com'),
    ],

    // Logging
    'security_logging' => [
        'enabled' => env('SECURITY_LOGGING_ENABLED', true),
        'log_all_form_submissions' => true,
        'log_spam_attempts' => true,
        'log_rate_limit_hits' => true,
    ],

];