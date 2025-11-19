<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class RequestTypesTableSeeder.
 */
class RequestTypesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $requestTypes = [
            [
                'name' => 'Maintenance Job Request',
                'acronym' => 'MJR',
                'description' => 'For ICT equipment maintenance, network service, and software/application support.',
                'sort_order' => 1,
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'MIS Assistance Request',
                'acronym' => 'MAR',
                'description' => 'For account management, report generation, and activity-based assistance.',
                'sort_order' => 2,
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('request_types')->insert($requestTypes);
    }
}
