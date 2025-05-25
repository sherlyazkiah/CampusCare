<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'facility_name' => 'Whiteboard',
                'facility_description' => 'One Whiteboard in classroom',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'facility_name' => 'Projector',
                'facility_description' => 'One high-resolution multimedia projector',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'facility_name' => 'Air Conditioner (AC)',
                'facility_description' => 'One wall-mounted AC unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('facility')->insert($data);
    }
}
