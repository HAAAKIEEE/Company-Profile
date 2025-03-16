<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat macam macam kebisaan dari rolepermission
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections',
        ];


        // menyimpan kebijakan ke role
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
        $designManager = Role::firstOrCreate([
            'name' => 'design_manager',
        ]);
        $designManagerPermissions = [
            'manage products',
            'manage principles',
            'manage testimonials',
        ];
        $designManager->syncPermissions($designManagerPermissions);
        $superAdmin = Role::firstOrCreate([
            'name' => 'super_admin'
        ]); //

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@example.com',
            'password' => bcrypt('rahasia'),
        ]);
        $user->assignRole($superAdmin);

        $user1 = User::create([
            'name' => 'Design Manager',
            'email' => 'design@example.com',
            'password' => bcrypt('rahasia'),
        ]);
        $user1->assignRole($designManager);
    }
}
