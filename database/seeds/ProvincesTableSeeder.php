<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ProvincesTableSeeder.
 */
class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $provinces = [
            [
                'province_code' => 'AKL',
                'name' => 'Aklan',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'province_code' => 'ATQ',
                'name' => 'Antique',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'province_code' => 'CAP',
                'name' => 'Capiz',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'province_code' => 'GUI',
                'name' => 'Guimaras',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'province_code' => 'ILO',
                'name' => 'Iloilo',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'province_code' => 'NEG',
                'name' => 'Negros Occidental',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
