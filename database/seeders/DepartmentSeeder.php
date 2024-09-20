<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            ['name' => 'Mechanical'],
            ['name' => 'Computer'],
            ['name' => 'ECE'],
            ['name' => 'EEE'],
            ['name' => 'AI'],
        ]);
    }
}