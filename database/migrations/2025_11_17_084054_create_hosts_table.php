<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hosts')) {
            Schema::create('hosts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
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
        
        Schema::dropIfExists('hosts');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View Host',
                'Store Host',
                'Update Host',
                'Delete Host'
            ])
            ->delete();
        
        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
