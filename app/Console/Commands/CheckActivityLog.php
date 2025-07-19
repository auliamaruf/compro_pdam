<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class CheckActivityLog extends Command
{
    protected $signature = 'check:activity-log';
    protected $description = 'Check recent activity logs';

    public function handle()
    {
        $this->info('Recent Activity Logs:');
        $this->newLine();

        $activities = Activity::with('subject')
            ->latest()
            ->take(10)
            ->get();

        if ($activities->isEmpty()) {
            $this->warn('No activity logs found yet.');
            $this->info('Try creating or updating some data in the admin panel first.');
            return;
        }

        $this->table(
            ['ID', 'Description', 'Subject', 'Causer', 'Time'],
            $activities->map(function ($activity) {
                return [
                    $activity->id,
                    $activity->description,
                    ($activity->subject_type ?? 'N/A') . ' #' . ($activity->subject_id ?? 'N/A'),
                    $activity->causer ? $activity->causer->name ?? 'System' : 'System',
                    $activity->created_at->format('d/m/Y H:i:s'),
                ];
            })->toArray()
        );

        $this->newLine();
        $this->info("Total activities: " . $activities->count());
    }
}
