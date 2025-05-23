<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
                [
                    'floor_number' => 5,
                    'floor_name' => 'Lantai 5',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'floor_number' => 6,
                    'floor_name' => 'Lantai 6',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'floor_number' => 7,
                    'floor_name' => 'Lantai 7',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
        ];
        DB::table('floors')->insert($data);
    }
}
