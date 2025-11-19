<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PriorityLevelsTableSeeder.
 */
class PriorityLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $priorityLevels = [
            [
                'name' => 'Low',
                'description' => 'Non-urgent issues that can be addressed within normal business hours.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Medium',
                'description' => 'Standard priority issues that should be addressed promptly.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'High',
                'description' => 'Urgent issues affecting multiple users or critical services.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Critical',
                'description' => 'Emergency issues requiring immediate attention and resolution.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('priority_levels')->insert($priorityLevels);
    }
}
