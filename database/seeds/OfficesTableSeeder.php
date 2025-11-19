<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class OfficesTableSeeder.
 */
class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $offices = [
            [
                'office_code' => 'DTI RO',
                'name' => 'Iloilo Regional Office',
                'active' => true,
                'office_types_id' => 1,
                'provinces_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'office_code' => 'DTI Aklan',
                'name' => 'Aklan Provincial Office',
                'active' => true,
                'office_types_id' => 2,
                'provinces_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'office_code' => 'DTI Antique',
                'name' => 'Antique Provincial Office',
                'active' => true,
                'office_types_id' => 2,
                'provinces_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'office_code' => 'DTI Capiz',
                'name' => 'Capiz Provincial Office',
                'active' => true,
                'office_types_id' => 2,
                'provinces_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'office_code' => 'DTI Guimaras',
                'name' => 'Guimaras Provincial Office',
                'active' => true,
                'office_types_id' => 2,
                'provinces_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'office_code' => 'DTI Iloilo',
                'name' => 'Iloilo Provincial Office',
                'active' => true,
                'office_types_id' => 2,
                'provinces_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'office_code' => 'DTI Negros Occ',
                'name' => 'Negros Occidental Provincial Office',
                'active' => true,
                'office_types_id' => 2,
                'provinces_id' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'office_code' => 'NC Iloilo',
                'name' => 'Negosyo Center - Iloilo',
                'active' => true,
                'office_types_id' => 3,
                'provinces_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('offices')->insert($offices);
    }
}
