<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('office_types')) {
            Schema::create('office_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->unsignedTinyInteger('active')->default(1);
                $table->softDeletes();
                $table->timestamps();
            });

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete OfficeType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ];

            // Use DB facade to insert permissions
            DB::table('permissions')->insert($permissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_types');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View OfficeType',
                'Store OfficeType',
                'Update OfficeType',
                'Delete OfficeType'
            ])
            ->delete();
    }
}
