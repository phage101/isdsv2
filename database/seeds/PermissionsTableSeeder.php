<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionsTableSeeder.
 */
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seed.
     */
    public function run()
    {
        $permissions = [
            // Province Permissions
            ['name' => 'View Province', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Province', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update Province', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Province', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Office Type Permissions
            ['name' => 'View OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Office Permissions
            ['name' => 'View Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Office', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Request Type Permissions
            ['name' => 'View RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Category Permissions
            ['name' => 'View Category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update Category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Category', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Sub Category Permissions
            ['name' => 'View SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Priority Level Permissions
            ['name' => 'View PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Status Permissions
            ['name' => 'View Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Medium Permissions
            ['name' => 'View Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Host Permissions
            ['name' => 'View Host', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Host', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update Host', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Host', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Division Permissions
            ['name' => 'View Division', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store Division', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update Division', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete Division', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Client Type Permissions
            ['name' => 'View ClientType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Store ClientType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Update ClientType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Delete ClientType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
