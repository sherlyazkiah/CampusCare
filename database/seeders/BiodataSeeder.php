<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BiodataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('biodata')->insert([
            [
                'id_user'   => 2, // pastikan user dengan ID ini sudah ada
                'id_number' => 2341720221,
                'name'      => 'tegar',
                'role_id'   => 2, // pastikan role dengan ID ini sudah ada
                'title'     => 'Manager',
                'email'     => 'tegar@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
