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
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();

                $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            });

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete SubCategory', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
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
    }
}
