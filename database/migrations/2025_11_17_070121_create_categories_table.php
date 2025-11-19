<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('request_types_id')->index();
                $table->string('name', 191);
                $table->text('description')->nullable();
                $table->boolean('active')->default(true);
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('request_types_id')->references('id')->on('request_types')->onDelete('cascade');
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
        
        Schema::dropIfExists('categories');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View Category',
                'Store Category',
                'Update Category',
                'Delete Category'
            ])
            ->delete();
        
        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
