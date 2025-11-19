<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('request_types')) {
            Schema::create('request_types', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 191);
                $table->string('acronym', 50)->nullable();
                $table->text('description')->nullable();
                $table->integer('sort_order')->default(0);
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
        
        Schema::dropIfExists('request_types');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View RequestType',
                'Store RequestType',
                'Update RequestType',
                'Delete RequestType'
            ])
            ->delete();
        
        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
