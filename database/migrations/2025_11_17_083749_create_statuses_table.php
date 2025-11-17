<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('statuses')) {
            Schema::create('statuses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->enum('status_type', ['helpdesk','meeting'])->default('helpdesk');
                $table->string('status_color')->nullable();
                $table->string('status_hex')->nullable();
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });

            // Add composite unique on name + status_type
            Schema::table('statuses', function (Blueprint $table) {
                $table->unique(['name', 'status_type']);
            });

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete Status', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
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
        Schema::dropIfExists('statuses');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View Status',
                'Store Status',
                'Update Status',
                'Delete Status'
            ])
            ->delete();
    }
}
