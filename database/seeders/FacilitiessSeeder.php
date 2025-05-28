<?php

namespace Database\Seeders;

use App\Models\Facility;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Facility::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
                'room_id' => 1,
                'jumlah' => 1,
            ],
            [
                'facility_name' => 'Air Conditioner (AC)',
                'floor_id' => 2,
                'room_id' => 3,
                'jumlah' => 1,
            ],
            [
                'facility_name' => 'Chair',
                'floor_id' => 2,
                'room_id' => 3,
                'jumlah' => 20,
            ],
            [
                'facility_name' => 'electric socket',
                'floor_id' => 2,
                'room_id' => 3,
                'jumlah' => 20,
            ],
            [
                'facility_name' => 'Lamp',
                'floor_id' => 2,
                'room_id' => 3,
                'jumlah' => 8,
            ],
            [
                'facility_name' => 'Lamp',
                'floor_id' => 3,
                'room_id' => 2,
                'jumlah' => 8,
            ],



        ]);
    }
}
