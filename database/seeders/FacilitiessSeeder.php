<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacilitiessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facilities')->insert([
            [
                'facility_name' => 'Proyektor LCD',
                'floor_id' => 1,
                'room_id' => 1,
                'jumlah' => 1,
            ],
            [
                'facility_name' => 'Whiteboard',
                'floor_id' => 1,
                'room_id' => 2,
                'jumlah' => 1,
            ],
            [
                'facility_name' => 'Air Conditioner (AC)',
                'floor_id' => 2,
                'room_id' => 3,
                'jumlah' => 1,
            ],
        ]);
    }
}
