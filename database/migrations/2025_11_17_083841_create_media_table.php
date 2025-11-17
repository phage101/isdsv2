<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('media')) {
            Schema::create('media', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->boolean('is_active')->default(true);
                $table->softDeletes();
                $table->timestamps();
            });

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete Medium', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
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
        Schema::dropIfExists('media');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View Medium',
                'Store Medium',
                'Update Medium',
                'Delete Medium'
            ])
            ->delete();
    }
}
