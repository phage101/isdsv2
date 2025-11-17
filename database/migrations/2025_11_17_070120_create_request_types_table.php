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
                $table->string('request_type', 191);
                $table->string('acronym', 50)->nullable();
                $table->text('description')->nullable();
                $table->integer('sort_order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete RequestType', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
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
    }
}
