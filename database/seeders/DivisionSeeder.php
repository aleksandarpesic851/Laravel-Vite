<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('divisions')->delete();
        $divisions = [
            ['id' => 1,  'name' => 'Heavy'],
            ['id' => 2,  'name' => 'Cruiser'],
            ['id' => 3,  'name' => 'Light Heavy'],
            ['id' => 4,  'name' => 'Super Middle'],
            ['id' => 5,  'name' => 'Middle'],
            ['id' => 6,  'name' => 'Super Welter'],
            ['id' => 7,  'name' => 'Welter'],
            ['id' => 8,  'name' => 'Super Light'],
            ['id' => 9,  'name' => 'Light'],
            ['id' => 10, 'name' => 'Super Feather'],
            ['id' => 11, 'name' => 'Feather'],
            ['id' => 12, 'name' => 'Super Bantam'],
            ['id' => 13, 'name' => 'Bantam'],
            ['id' => 14, 'name' => 'Super Fly'],
            ['id' => 15, 'name' => 'Fly'],
            ['id' => 16, 'name' => 'JR Fly'],
            ['id' => 17, 'name' => 'Minimum']
        ];

        DB::table('divisions')->insert($divisions);
    }
}