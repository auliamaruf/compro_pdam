<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AnalyzeNavigationGroups extends Command
{
    protected $signature = 'analyze:navigation-groups';
    protected $description = 'Analyze and display navigation groups for all Filament resources';

    public function handle()
    {
        $this->info('🧭 ANALISIS NAVIGATION GROUPS - ADMIN PANEL PDAM');
        $this->newLine();

        $resourcePath = app_path('Filament/Resources');
        $resources = File::glob($resourcePath . '/*Resource.php');
        
        $groups = [];
        
        foreach ($resources as $resourceFile) {
            $content = File::get($resourceFile);
            $resourceName = basename($resourceFile, '.php');
            
            // Extract navigation group
            if (preg_match('/navigationGroup\s*=\s*[\'"]([^\'"]+)[\'"]/', $content, $matches)) {
                $group = $matches[1];
            } else {
                $group = 'Tanpa Group';
            }
            
            // Extract navigation sort
            $sort = 999;
            if (preg_match('/navigationSort\s*=\s*(\d+)/', $content, $matches)) {
                $sort = (int) $matches[1];
            }
            
            // Extract navigation label
            $label = $resourceName;
            if (preg_match('/navigationLabel\s*=\s*[\'"]([^\'"]+)[\'"]/', $content, $matches)) {
                $label = $matches[1];
            }
            
            if (!isset($groups[$group])) {
                $groups[$group] = [];
            }
            
            $groups[$group][] = [
                'name' => $resourceName,
                'label' => $label,
                'sort' => $sort
            ];
        }
        
        // Sort groups and resources
        ksort($groups);
        foreach ($groups as $groupName => $resources) {
            usort($groups[$groupName], fn($a, $b) => $a['sort'] <=> $b['sort']);
        }
        
        // Display results
        foreach ($groups as $groupName => $resources) {
            $this->info("📁 {$groupName}");
            foreach ($resources as $resource) {
                $sortInfo = $resource['sort'] < 999 ? " (sort: {$resource['sort']})" : "";
                $this->line("   └── {$resource['label']}{$sortInfo}");
            }
            $this->newLine();
        }
        
        // Display AdminPanelProvider groups
        $panelProviderPath = app_path('Providers/Filament/AdminPanelProvider.php');
        $panelContent = File::get($panelProviderPath);
        
        if (preg_match('/navigationGroups\(\[\s*([^\]]+)\]\)/', $panelContent, $matches)) {
            $definedGroups = [];
            preg_match_all('/[\'"]([^\'"]+)[\'"]/', $matches[1], $groupMatches);
            $definedGroups = $groupMatches[1];
            
            $this->info('🔧 NAVIGATION GROUPS YANG DIDEFINISIKAN DI ADMIN PANEL:');
            foreach ($definedGroups as $index => $group) {
                $this->line("   " . ($index + 1) . ". {$group}");
            }
        }
        
        $this->newLine();
        $this->info('✅ Analisis navigation groups selesai!');
        
        return 0;
    }
}
