<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SubCategoriesTableSeeder.
 */
class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $subCategories = [
            // Maintenance Job Request - ICT Equipment Service (categories_id = 1)
            [
                'categories_id' => 1,
                'name' => 'Desktop',
                'description' => 'Desktop hardware maintenance',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 1,
                'name' => 'Laptop',
                'description' => 'Laptop hardware maintenance',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 1,
                'name' => 'Printer',
                'description' => 'Printer maintenance and troubleshooting',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 1,
                'name' => 'Others',
                'description' => 'Other hardware maintenance',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Maintenance Job Request - Network Service (categories_id = 2)
            [
                'categories_id' => 2,
                'name' => 'Internet Access',
                'description' => 'Internet connection issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 2,
                'name' => 'LAN',
                'description' => 'Local area network issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 2,
                'name' => 'Network Sharing',
                'description' => 'Shared folders/drives access',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 2,
                'name' => 'Others',
                'description' => 'Other network issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Maintenance Job Request - Software/Application Service (categories_id = 3)
            [
                'categories_id' => 3,
                'name' => 'Payroll System',
                'description' => 'Payroll system access and errors',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 3,
                'name' => 'eNGAS',
                'description' => 'eNGAS system access and issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 3,
                'name' => 'HR System',
                'description' => 'HR system access and troubleshooting',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 3,
                'name' => 'DTR System',
                'description' => 'Attendance/DTR system issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 3,
                'name' => 'iMMIS',
                'description' => 'iMMIS access and reporting issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 3,
                'name' => 'Others',
                'description' => 'Other software/application issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // MIS Assistance Request - Account Management (categories_id = 4)
            [
                'categories_id' => 4,
                'name' => 'O365 Account',
                'description' => 'Office 365 account management',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 4,
                'name' => 'IHRIS',
                'description' => 'IHRIS account issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 4,
                'name' => 'eNGAS',
                'description' => 'eNGAS account issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 4,
                'name' => 'iMMIS',
                'description' => 'iMMIS account issues',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // MIS Assistance Request - Report Generation (categories_id = 5)
            [
                'categories_id' => 5,
                'name' => 'O365 / IHRIS / eNGAS / iMMIS',
                'description' => 'Report generation and formatting',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // MIS Assistance Request - Activity-Based Assistance (categories_id = 6)
            [
                'categories_id' => 6,
                'name' => 'Graphics',
                'description' => 'Graphic design assistance',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 6,
                'name' => 'Video Editing',
                'description' => 'Video editing assistance',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 6,
                'name' => 'Pitch Deck/PPT Presentation',
                'description' => 'Presentation creation/editing',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 6,
                'name' => 'Set Up Venue',
                'description' => 'AV/network setup for events',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'categories_id' => 6,
                'name' => 'Others',
                'description' => 'Miscellaneous activity-based assistance',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // MIS Assistance Request - Others (categories_id = 7)
            [
                'categories_id' => 7,
                'name' => 'Others',
                'description' => 'Other requests not categorized',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('sub_categories')->insert($subCategories);
    }
}
