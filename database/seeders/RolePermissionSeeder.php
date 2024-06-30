<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner'
        ]);
        
        $hrdRole = Role::create([
            'name' => 'hrd'
        ]);
        
        $employeeRole = Role::create([
            'name' => 'employee'
        ]);
        
        // super admin
        $userOwner = User::create([
            'name' => 'Alif Safrudin',
            'occupation' => 'CEO',
            'identity_number' => '12116516',
            'email' => 'alifsafrudin@owner.com',
            'phone' => '085692343575',
            'avatar' => 'images/default-avatar.png',
            'password' => bcrypt('password')
        ]);
        
        $userOwner->assignRole($ownerRole);
    }
}
