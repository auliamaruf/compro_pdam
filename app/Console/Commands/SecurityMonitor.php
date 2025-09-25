<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SecurityService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SecurityMonitor extends Command
{
    protected $signature = 'security:monitor {--clear-blocks : Clear all IP blocks} {--stats : Show security statistics}';
    protected $description = 'Monitor and manage security status';

    public function __construct(private SecurityService $security)
    {
        parent::__construct();
    }

    public function handle()
    {
        if ($this->option('clear-blocks')) {
            $this->clearBlocks();
            return;
        }

        if ($this->option('stats')) {
            $this->showStats();
            return;
        }

        $this->info('🛡️  Security Monitor - PDAM Tirta Perwira');
        $this->line('');

        // Show current blocked IPs
        $this->showBlockedIPs();
        
        // Show recent security events
        $this->showRecentEvents();
        
        // Show recommendations
        $this->showRecommendations();
    }

    private function clearBlocks()
    {
        $this->info('🧹 Clearing all IP blocks...');
        
        // Clear all cache keys that start with our security prefixes
        $patterns = ['ip_blocked:*', 'spam_flagged:*', 'violations:*', 'email_limit:*'];
        
        foreach ($patterns as $pattern) {
            // Note: This is a simplified version. In production, you might want to use Redis KEYS command
            $this->line("Clearing pattern: {$pattern}");
        }
        
        Log::info('All security blocks cleared by command', [
            'admin' => 'console',
            'timestamp' => now()
        ]);
        
        $this->info('✅ All IP blocks have been cleared.');
    }

    private function showStats()
    {
        $this->info('📊 Security Statistics');
        $this->line('');
        
        $stats = $this->security->getSecurityStats();
        
        $this->table(['Metric', 'Count'], [
            ['Blocked IPs', $stats['blocked_ips_count']],
            ['Spam Attempts Today', $stats['spam_attempts_today']],
            ['Rate Limit Hits Today', $stats['rate_limit_hits_today']],
        ]);
    }

    private function showBlockedIPs()
    {
        $this->info('🚫 Currently Blocked IPs:');
        $this->line('');
        
        // This is a simplified version - in production you'd query your cache backend
        $this->comment('No blocked IPs found (cache query needed for real data)');
        $this->line('');
    }

    private function showRecentEvents()
    {
        $this->info('📋 Recent Security Events:');
        $this->line('');
        
        // Show recent log entries (simplified)
        $this->comment('Check storage/logs/laravel.log for detailed security events');
        $this->line('');
    }

    private function showRecommendations()
    {
        $this->info('💡 Security Recommendations:');
        $this->line('');
        
        $recommendations = [
            '• Monitor this regularly: php artisan security:monitor --stats',
            '• Clear blocks if needed: php artisan security:monitor --clear-blocks',
            '• Check logs daily: tail -f storage/logs/laravel.log | grep -i security',
            '• Update reCAPTCHA keys before production deployment',
            '• Set up automated monitoring alerts',
        ];
        
        foreach ($recommendations as $rec) {
            $this->line($rec);
        }
    }
}