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
                $table->boolean('active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });

            // Add composite unique on name + status_type
            Schema::table('statuses', function (Blueprint $table) {
                $table->unique(['name', 'status_type']);
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
        
        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
