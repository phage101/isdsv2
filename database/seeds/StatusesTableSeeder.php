<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class StatusesTableSeeder.
 */
class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'Open',
                'status_type' => 'helpdesk',
                'status_color' => 'info',
                'status_hex' => '#17a2b8',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Assigned',
                'status_type' => 'helpdesk',
                'status_color' => 'warning',
                'status_hex' => '#ffc107',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'In Progress',
                'status_type' => 'helpdesk',
                'status_color' => 'primary',
                'status_hex' => '#007bff',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pending User',
                'status_type' => 'helpdesk',
                'status_color' => 'secondary',
                'status_hex' => '#6c757d',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'On Hold',
                'status_type' => 'helpdesk',
                'status_color' => 'warning',
                'status_hex' => '#ffc107',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Resolved',
                'status_type' => 'helpdesk',
                'status_color' => 'success',
                'status_hex' => '#28a745',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Closed',
                'status_type' => 'helpdesk',
                'status_color' => 'success',
                'status_hex' => '#20c997',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cancelled',
                'status_type' => 'helpdesk',
                'status_color' => 'danger',
                'status_hex' => '#dc3545',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Rejected',
                'status_type' => 'helpdesk',
                'status_color' => 'danger',
                'status_hex' => '#e74c3c',
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('statuses')->insert($statuses);
    }
}
