<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HeroBanner;
use Spatie\Activitylog\Models\Activity;

class TestSimpleActivityLog extends Command
{
    protected $signature = 'test:simple-activity-log';
    protected $description = 'Test Simple Activity Log functionality';

    public function handle()
    {
        $this->info('Testing Simple Activity Log functionality...');
        $this->newLine();

        // Test 1: Create hero banner
        $this->info('1. Creating a test hero banner...');
        $heroBanner = HeroBanner::create([
            'title' => 'Simple Test Hero Banner',
            'subtitle' => 'Testing simple activity log',
            'description' => 'This is a test for basic tracking',
            'text_position' => 'center',
            'primary_cta_text' => 'Learn More',
            'primary_cta_link' => '#',
            'sort_order' => 999,
            'is_active' => true,
        ]);
        
        $this->info("✅ Hero Banner created");
        $this->newLine();

        // Test 2: Update hero banner
        $this->info('2. Updating hero banner...');
        $heroBanner->update([
            'title' => 'Updated Simple Test Hero Banner',
            'overlay_color' => '#333333',
            'overlay_opacity' => 60,
            'is_active' => false,
        ]);
        $this->info("✅ Hero banner updated");
        $this->newLine();

        // Test 3: Check activities
        $this->info('3. Recent activity logs:');
        $activities = Activity::with('subject')
            ->latest()
            ->take(5)
            ->get();
        
        if ($activities->count() > 0) {
            foreach ($activities as $index => $activity) {
                $num = $index + 1;
                $this->line("  {$num}. {$activity->description} ({$activity->created_at->format('H:i:s')})");
            }
        } else {
            $this->warn('  No activity logs found');
        }

        $this->newLine();
        
        // Cleanup
        $this->info('4. Cleaning up...');
        $heroBanner->delete();
        $this->info("✅ Test data cleaned up");
        
        $this->newLine();
        $this->info('🎉 Simple Activity Log test completed successfully!');
        
        return 0;
    }
}
