<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'boxer']);
        Permission::create(['name' => 'match-maker']);
        Permission::create(['name' => 'manager']);
        Permission::create(['name' => 'promoter']);

        $boxerRole = Role::create(['name' => 'Boxer']);
        $matchMakerRole = Role::create(['name' => 'MatchMaker']);
        $managerRole = Role::create(['name' => 'Manager']);
        $promoterRole = Role::create(['name' => 'Promoter']);

        $boxerRole->givePermissionTo(['boxer']);
        $matchMakerRole->givePermissionTo(['match-maker']);
        $managerRole->givePermissionTo(['manager']);
        $promoterRole->givePermissionTo(['promoter']);
    }
}