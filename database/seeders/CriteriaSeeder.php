<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('criteria')->insert([
            ['name' => 'Damage Severity', 'type' => 'benefit', 'weight' => 0.2],
            ['name' => 'Usage Importance', 'type' => 'benefit', 'weight' => 0.15],
            ['name' => 'Safety Concern', 'type' => 'benefit', 'weight' => 0.2],
            ['name' => 'Repair Urgency', 'type' => 'benefit', 'weight' => 0.2],
            ['name' => 'Impact on Many People', 'type' => 'benefit', 'weight' => 0.15],
            ['name' => 'Time to Repair', 'type' => 'cost', 'weight' => 0.1],
        ]);
    }
}
