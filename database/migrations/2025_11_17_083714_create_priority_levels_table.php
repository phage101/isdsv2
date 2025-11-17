<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriorityLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('priority_levels')) {
            Schema::create('priority_levels', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('description')->nullable();
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete PriorityLevel', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
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
        Schema::dropIfExists('priority_levels');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View PriorityLevel',
                'Store PriorityLevel',
                'Update PriorityLevel',
                'Delete PriorityLevel'
            ])
            ->delete();
    }
}
