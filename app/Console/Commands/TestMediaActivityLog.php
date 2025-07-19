<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HeroBanner;
use Spatie\Activitylog\Models\Activity;

class TestMediaActivityLog extends Command
{
    protected $signature = 'test:media-activity-log';
    protected $description = 'Test Media Activity Log functionality';

    public function handle()
    {
        $this->info('Testing Media Activity Log functionality...');
        $this->newLine();

        // Test 1: Create hero banner
        $this->info('1. Creating a test hero banner...');
        $heroBanner = HeroBanner::create([
            'title' => 'Test Hero Banner for Media',
            'subtitle' => 'Testing media activity log',
            'description' => 'This is a test for media tracking',
            'text_position' => 'center',
            'primary_cta_text' => 'Learn More',
            'primary_cta_link' => '#',
            'sort_order' => 999,
            'is_active' => true,
        ]);
        
        $this->info("Hero Banner created with ID: " . $heroBanner->getAttribute('id'));
        $this->newLine();

        // Test 2: Simulate media upload (will be tracked by our event listeners)
        $this->info('2. Simulating media upload...');
        $this->info('(Media upload akan tracked saat admin upload file via Filament)');
        $this->newLine();

        // Test 3: Check recent activities
        $this->info('3. Checking recent activity logs...');
        $activities = Activity::with('subject')
            ->where('subject_type', HeroBanner::class)
            ->latest()
            ->take(5)
            ->get();
        
        if ($activities->count() > 0) {
            $this->table(
                ['ID', 'Description', 'Subject', 'Properties', 'Time'],
                $activities->map(function ($activity) {
                    return [
                        $activity->id,
                        $activity->description,
                        $activity->subject_type . ' #' . $activity->subject_id,
                        $activity->properties ? json_encode($activity->properties, JSON_PRETTY_PRINT) : 'N/A',
                        $activity->created_at->format('d/m/Y H:i:s'),
                    ];
                })->toArray()
            );
        } else {
            $this->warn('No activity logs found for HeroBanner');
        }

        $this->newLine();
        
        // Test 4: Update hero banner
        $this->info('4. Updating hero banner to test field tracking...');
        $heroBanner->update([
            'title' => 'Updated Test Hero Banner',
            'overlay_color' => '#000000',
            'overlay_opacity' => 50,
        ]);
        $this->info('Hero banner updated');
        $this->newLine();

        // Test 5: Check final activities
        $this->info('5. Final activity check...');
        $finalActivities = Activity::with('subject')
            ->where('subject_type', HeroBanner::class)
            ->where('subject_id', $heroBanner->id)
            ->latest()
            ->take(3)
            ->get();
            
        if ($finalActivities->count() > 0) {
            $this->table(
                ['ID', 'Description', 'Changes', 'Time'],
                $finalActivities->map(function ($activity) {
                    return [
                        $activity->id,
                        $activity->description,
                        $activity->properties ? json_encode($activity->properties->get('attributes', []), JSON_PRETTY_PRINT) : 'N/A',
                        $activity->created_at->format('d/m/Y H:i:s'),
                    ];
                })->toArray()
            );
        }

        $this->newLine();
        $this->info('✅ Media Activity Log test completed!');
        
        // Cleanup
        $this->info('Cleaning up test data...');
        $heroBanner->delete();
        $this->info('Test data cleaned up.');
    }
}
