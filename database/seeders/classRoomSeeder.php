<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\classRoom;

class classRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['class_name' => 'TI_2A'],
            ['class_name' => 'TI_2B'],
            ['class_name' => 'TI_2C'],
            ['class_name' => 'TI_2D'],
            ['class_name' => 'TI_2E'],
            ['class_name' => 'TI_2F'],
            ['class_name' =>  'TI_2G'],
            ['class_name' => 'TI_2H'],
            ['class_name' => 'TI_2I'],
        ];

        foreach ($classes as $class) {
            classRoom::create($class);
        }
    }
}
