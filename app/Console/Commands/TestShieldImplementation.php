<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class TestShieldImplementation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:shield';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Filament Shield implementation for PDAM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🛡️ TESTING FILAMENT SHIELD IMPLEMENTATION FOR PDAM');
        $this->newLine();

        // Test 1: Check permissions count
        $permissionCount = Permission::count();
        $this->info("✅ Total Permissions Generated: {$permissionCount}");

        // Test 2: Check roles count
        $roleCount = Role::count();
        $this->info("✅ Total Roles Created: {$roleCount}");

        // Test 3: List roles
        $this->info("\n📋 Available Roles:");
        Role::all()->each(function ($role) {
            $permissionCount = $role->permissions()->count();
            $this->line("   • {$role->name} ({$permissionCount} permissions)");
        });

        // Test 4: Check super admin user
        $superAdmin = User::role('super_admin')->first();
        if ($superAdmin) {
            $this->info("\n👑 Super Admin User: {$superAdmin->name} ({$superAdmin->email})");
        } else {
            $this->warn("\n⚠️  No Super Admin user found!");
        }

        // Test 5: Sample permissions for each resource
        $this->info("\n🔐 Sample Resource Permissions:");
        $resources = [
            'company_setting', 'news', 'service', 'contact_message', 
            'online_complaint', 'hero_banner', 'navigation_menu'
        ];

        foreach ($resources as $resource) {
            $perms = Permission::where('name', 'like', "%{$resource}%")->count();
            $this->line("   • {$resource}: {$perms} permissions");
        }

        // Test 6: Check if policies exist
        $this->info("\n📜 Generated Policies:");
        $policyPath = app_path('Policies');
        $policies = collect(scandir($policyPath))->filter(fn($file) => str_ends_with($file, 'Policy.php'));
        
        $policies->each(function ($policy) {
            $this->line("   • {$policy}");
        });

        $this->newLine();
        $this->info('🎉 Shield implementation test completed!');
        $this->info('💡 You can now access /admin to test role-based access control');
        
        return 0;
    }
}
