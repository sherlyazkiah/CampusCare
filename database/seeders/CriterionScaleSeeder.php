<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriterionScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('criterion_scales')->insert([

            // Damage Severity (criterion_id = 1)
            ['criterion_id' => 1, 'scale_value' => 1, 'scale_description' => 'Very Minor(Minimal Damage)'],
            ['criterion_id' => 1, 'scale_value' => 2, 'scale_description' => 'Minor(Still Functions Well)'],
            ['criterion_id' => 1, 'scale_value' => 3, 'scale_description' => 'Moderate damage(partially usable)'],
            ['criterion_id' => 1, 'scale_value' => 4, 'scale_description' => 'Severe damage(limited usability)'],
            ['criterion_id' => 1, 'scale_value' => 5, 'scale_description' => 'Completely unusable or broken'],





            // Damage Severity (criterion_id = 2)
            ['criterion_id' => 2, 'scale_value' => 1, 'scale_description' => 'Rarely used'],
            ['criterion_id' => 2, 'scale_value' => 2, 'scale_description' => 'Occasionally used'],
            ['criterion_id' => 2, 'scale_value' => 3, 'scale_description' => 'Moderately important'],
            ['criterion_id' => 2, 'scale_value' => 4, 'scale_description' => 'Frequently used'],
            ['criterion_id' => 2, 'scale_value' => 5, 'scale_description' => 'Used all the time'],

            // Safety Concern (criterion_id = 3)
            ['criterion_id' => 3, 'scale_value' => 1, 'scale_description' => 'No safety risk'],
            ['criterion_id' => 3, 'scale_value' => 2, 'scale_description' => 'Very low risk'],
            ['criterion_id' => 3, 'scale_value' => 3, 'scale_description' => 'Moderate risk'],
            ['criterion_id' => 3, 'scale_value' => 4, 'scale_description' => 'High risk of minor injury'],
            ['criterion_id' => 3, 'scale_value' => 5, 'scale_description' => 'High risk of serious injury'],
            
             // C4 - Repair Urgency (criterion_id = 4)
            ['criterion_id' => 4, 'scale_value' => 1, 'scale_description' => 'Can wait, not urgent'],
            ['criterion_id' => 4, 'scale_value' => 2, 'scale_description' => 'Low urgency'],
            ['criterion_id' => 4, 'scale_value' => 3, 'scale_description' => 'Needs repair soon'],
            ['criterion_id' => 4, 'scale_value' => 4, 'scale_description' => 'High urgency'],
            ['criterion_id' => 4, 'scale_value' => 5, 'scale_description' => 'Needs immediate action'],

            // C5 - Impact on Many People (criterion_id = 5)
            ['criterion_id' => 5, 'scale_value' => 1, 'scale_description' => 'Affects very few (1-2 people)'],
            ['criterion_id' => 5, 'scale_value' => 2, 'scale_description' => 'Affects a small group (3-5 people)'],
            ['criterion_id' => 5, 'scale_value' => 3, 'scale_description' => 'Affects a moderate group (6-15 people)'],
            ['criterion_id' => 5, 'scale_value' => 4, 'scale_description' => 'Affects a large group (16-30 people)'],
            ['criterion_id' => 5, 'scale_value' => 5, 'scale_description' => 'Affects very many (31+ people)'],

            // C6 - Impact on Many People (criterion_id = 6)
            ['criterion_id' => 6, 'scale_value' => 1, 'scale_description' => 'More than 1 month'],
            ['criterion_id' => 6, 'scale_value' => 2, 'scale_description' => 'Several weeks'],
            ['criterion_id' => 6, 'scale_value' => 3, 'scale_description' => '1-2 weeks'],
            ['criterion_id' => 6, 'scale_value' => 4, 'scale_description' => 'Few days'],
            ['criterion_id' => 6, 'scale_value' => 5, 'scale_description' => 'Can be fixed within a day'],
    ]);
    }
}
