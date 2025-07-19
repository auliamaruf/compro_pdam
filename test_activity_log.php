<?php

// Test script untuk Activity Log
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\News;
use App\Models\CompanySetting;
use Spatie\Activitylog\Models\Activity;

echo "Testing Activity Log...\n\n";

// Test 1: Create news
echo "1. Creating a test news...\n";
$news = News::create([
    'title' => 'Test News Activity Log',
    'slug' => 'test-news-activity-log',
    'excerpt' => 'Testing activity log functionality',
    'content' => 'This is a test content for activity log',
    'type' => 'news',
    'status' => 'published',
    'is_featured' => false,
    'published_at' => now(),
]);

echo "News created with ID: " . $news->id . "\n\n";

// Test 2: Update news
echo "2. Updating the news...\n";
$news->update([
    'title' => 'Updated Test News Activity Log',
    'is_featured' => true,
]);

echo "News updated\n\n";

// Test 3: Check activities
echo "3. Checking activity logs...\n";
$activities = Activity::with('subject')->latest()->take(5)->get();

foreach ($activities as $activity) {
    echo "- " . $activity->description . " (" . $activity->created_at . ")\n";
    if ($activity->properties) {
        echo "  Properties: " . json_encode($activity->properties, JSON_PRETTY_PRINT) . "\n";
    }
    echo "\n";
}

echo "Activity Log test completed!\n";
