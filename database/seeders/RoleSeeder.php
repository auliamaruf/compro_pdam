<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles specific for PDAM
        $roles = [
            [
                'name' => 'super_admin',
                'description' => 'Administrator dengan akses penuh ke semua fitur sistem'
            ],
            [
                'name' => 'content_manager',
                'description' => 'Mengelola konten website (berita, layanan, banner)'
            ],
            [
                'name' => 'operator',
                'description' => 'Mengelola pesan kontak dan pengaduan masyarakat'
            ],
            [
                'name' => 'viewer',
                'description' => 'Hanya dapat melihat laporan dan data (read-only)'
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role['name'],
                'guard_name' => 'web',
            ]);
        }

        // Assign permissions for Content Manager
        $contentManager = Role::where('name', 'content_manager')->first();
        if ($contentManager) {
            $contentPermissions = Permission::where('name', 'like', '%news%')
                ->orWhere('name', 'like', '%service%')
                ->orWhere('name', 'like', '%hero_banner%')
                ->orWhere('name', 'like', '%company_setting%')
                ->orWhere('name', 'like', '%navigation_menu%')
                ->orWhere('name', 'like', '%page%')
                ->orWhere('name', 'like', '%organization_structure%')
                ->get();
            
            $contentManager->syncPermissions($contentPermissions);
        }

        // Assign permissions for Operator
        $operator = Role::where('name', 'operator')->first();
        if ($operator) {
            $operatorPermissions = Permission::where('name', 'like', '%contact_message%')
                ->orWhere('name', 'like', '%online_complaint%')
                ->orWhere('name', 'like', '%comment%')
                ->get();
            
            $operator->syncPermissions($operatorPermissions);
        }

        // Assign permissions for Viewer
        $viewer = Role::where('name', 'viewer')->first();
        if ($viewer) {
            $viewerPermissions = Permission::where('name', 'like', 'view_%')
                ->orWhere('name', 'like', 'view_any_%')
                ->get();
            
            $viewer->syncPermissions($viewerPermissions);
        }

        // Make sure user ID 1 has super_admin role
        $user = \App\Models\User::find(1);
        if ($user) {
            $user->assignRole('super_admin');
        }

        echo "✅ Roles and permissions have been set up successfully!\n";
        echo "🔐 Super Admin: Full access to everything\n";
        echo "📝 Content Manager: News, Services, Hero Banner, Company Settings\n";
        echo "👥 Operator: Contact Messages, Online Complaints, Comments\n";
        echo "👁️ Viewer: Read-only access to all data\n";
    }
}
