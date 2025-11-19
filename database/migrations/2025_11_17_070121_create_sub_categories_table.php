<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sub_categories')) {
            Schema::create('sub_categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('categories_id')->index();
                $table->string('name', 191);
                $table->text('description')->nullable();
                $table->boolean('active')->default(true);
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
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
        
        Schema::dropIfExists('sub_categories');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View SubCategory',
                'Store SubCategory',
                'Update SubCategory',
                'Delete SubCategory'
            ])
            ->delete();
        
        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
