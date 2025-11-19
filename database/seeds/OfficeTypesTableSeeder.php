<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class OfficeTypesTableSeeder.
 */
class OfficeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $officeTypes = [
            [
                'name' => 'Regional',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Provincial',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Municipal',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('office_types')->insert($officeTypes);
    }
}
