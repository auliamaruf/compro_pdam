<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use App\Models\CompanySetting;
use Spatie\Activitylog\Models\Activity;

class TestActivityLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:activity-log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Activity Log functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing Activity Log functionality...');
        $this->newLine();

        // Get the first user for author_id
        $user = \App\Models\User::first();
        if (!$user) {
            $this->error('No user found. Please create a user first.');
            return 1;
        }

        // Test 1: Create news
        $this->info('1. Creating a test news...');
        $news = News::create([
            'title' => 'Test News Activity Log',
            'slug' => 'test-news-activity-log-' . time(),
            'excerpt' => 'Testing activity log functionality',
            'content' => 'This is a test content for activity log',
            'type' => 'news',
            'status' => 'published',
            'is_featured' => false,
            'published_at' => now(),
            'author_id' => $user->getAttribute('id'),
        ]);
        
        $this->info("News created with ID: " . $news->getAttribute('id'));
        $this->newLine();

        // Test 2: Update news
        $this->info('2. Updating the news...');
        $news->update([
            'title' => 'Updated Test News Activity Log',
            'is_featured' => true,
        ]);
        $this->info('News updated');
        $this->newLine();

        // Test 3: Check activities
        $this->info('3. Checking recent activity logs...');
        $activities = Activity::with('subject')->latest()->take(10)->get();
        
        if ($activities->count() > 0) {
            $this->table(
                ['ID', 'Description', 'Subject Type', 'Subject ID', 'Created At'],
                $activities->map(function ($activity) {
                    return [
                        $activity->id,
                        $activity->description,
                        $activity->subject_type ?? 'N/A',
                        $activity->subject_id ?? 'N/A',
                        $activity->created_at->format('Y-m-d H:i:s'),
                    ];
                })->toArray()
            );
        } else {
            $this->warn('No activity logs found');
        }

        $this->newLine();
        $this->info('Activity Log test completed!');

        // Clean up test data
        $this->info('Cleaning up test data...');
        $news->delete();
        $this->info('Test data cleaned up.');
    }
}
