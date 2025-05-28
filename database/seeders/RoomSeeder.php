<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Room::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil ID lantai berdasarkan nama
        $floor5 = DB::table('floors')->where('floor_name', 'Lantai 5')->first();
        $floor6 = DB::table('floors')->where('floor_name', 'Lantai 6')->first();
        $floor7 = DB::table('floors')->where('floor_name', 'Lantai 7')->first();

        // Masukkan data ruangan
        $data = [
            [
                'floor_id' => $floor5->floor_id,
                'room_name' => 'RT 1 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor5->floor_id,
                'room_name' => 'RT 2 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor5->floor_id,
                'room_name' => 'RT 3 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor5->floor_id,
                'room_name' => 'RT 4 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor6->floor_id,
                'room_name' => 'LSI1 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor6->floor_id,
                'room_name' => 'LSI2 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor6->floor_id,
                'room_name' => 'LSI3 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor7->floor_id,
                'room_name' => 'LPR1 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor7->floor_id,
                'room_name' => 'LPR2 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'floor_id' => $floor7->floor_id,
                'room_name' => 'LPR3 Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('rooms')->insert($data);
    }
}
