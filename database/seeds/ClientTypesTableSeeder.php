<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientTypesTableSeeder.
 */
class ClientTypesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $clientTypes = [
            [
                'name' => 'Citizen',
                'description' => 'A Citizen is an individual Filipino national availing government services for personal transactions or inquiries.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Business',
                'description' => 'A Business is any registered company or enterprise seeking government services for its operations, permits, or official transactions.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Government',
                'description' => 'A Government client is any national or local government office requesting services or conducting official transactions with the agency.',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('client_types')->insert($clientTypes);
    }
}
