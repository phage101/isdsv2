<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class DivisionsTableSeeder.
 */
class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $divisions = [
            [
                'name' => 'Management Information Service Unit',
                'division_code' => 'MIS',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Office of the Regional Director',
                'division_code' => 'ORD',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Business Development Division',
                'division_code' => 'BDD',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Finance and Admin Division',
                'division_code' => 'FAD',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Consumer Protection Division',
                'division_code' => 'CPD',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Commision On Audit',
                'division_code' => 'COA',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Industry Development Division',
                'division_code' => 'IDD',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('divisions')->insert($divisions);
    }
}
