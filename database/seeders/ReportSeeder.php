<?php

namespace Database\Seeders;

use App\Models\DamageReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DamageReport::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('damage_report')->insert([
            [
                'report_name' => 'error lcd',
                'description' => 'layar lcd tidak menampilkan',
                'status' => 'In Progress',
                'user_id' => 1,
                'role_id' => 1,
                'floor_id' => 1,
                'room_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('damage_report')->insert([
            [
                'report_name' => 'error wifi',
                'description' => 'wifi lemot',
                'status' => 'In Progress',
                'user_id' => 1,
                'role_id' => 2,
                'floor_id' => 1,
                'room_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
