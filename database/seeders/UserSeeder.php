<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
    
        'username' => 'Majid',
        'password' => Hash::make('123456'),
        'role_id' => 1,


        ]);

        User::create([

            'username' => 'Tegar',
            'password' => Hash::make('123456'),
            'role_id' => 2,


        ]);
    }
}
