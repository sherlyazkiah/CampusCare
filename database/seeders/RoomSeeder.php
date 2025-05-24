<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                'floor_id' => $floor6->floor_id,
                'room_name' => 'LSI Room',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('rooms')->insert($data);
    }
}
