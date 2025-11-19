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
                $table->boolean('active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Disable foreign key constraints temporarily
        Schema::disableForeignKeyConstraints();
        
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
        
        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
