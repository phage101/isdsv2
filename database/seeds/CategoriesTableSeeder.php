<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoriesTableSeeder.
 */
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $categories = [
            // Maintenance Job Request (request_types_id = 1) categories
            [
                'request_types_id' => 1,
                'name' => 'ICT Equipment Service',
                'description' => 'Hardware maintenance and support for ICT equipment.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'request_types_id' => 1,
                'name' => 'Network Service',
                'description' => 'Network connectivity and infrastructure support.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'request_types_id' => 1,
                'name' => 'Software/Application Service',
                'description' => 'Software and application support and troubleshooting.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // MIS Assistance Request (request_types_id = 2) categories
            [
                'request_types_id' => 2,
                'name' => 'Account Management',
                'description' => 'User account creation, modification, and access management.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'request_types_id' => 2,
                'name' => 'Report Generation',
                'description' => 'Report creation, generation, and formatting assistance.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'request_types_id' => 2,
                'name' => 'Activity-Based Assistance',
                'description' => 'Support for special activities and events.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'request_types_id' => 2,
                'name' => 'Others',
                'description' => 'Other miscellaneous MIS assistance requests.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
