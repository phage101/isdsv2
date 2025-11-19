<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('offices')) {
            Schema::create('offices', function (Blueprint $table) {
                $table->bigIncrements('id');

                // Core identifiers
                $table->string('office_code', 50)->unique();
                $table->string('name');
                $table->boolean('active')->default(true);

                // Foreign keys
                $table->unsignedBigInteger('office_types_id');
                $table->unsignedBigInteger('provinces_id');

                // Soft deletes & timestamps
                $table->softDeletes();
                $table->timestamps();

                // Indexes & compound index
                $table->index(['office_types_id', 'provinces_id']);

                // Constraints / foreign keys
                $table->foreign('office_types_id')
                      ->references('id')
                      ->on('office_types')
                      ->onUpdate('cascade')
                      ->onDelete('restrict');

                $table->foreign('provinces_id')
                      ->references('id')
                      ->on('provinces')
                      ->onUpdate('cascade')
                      ->onDelete('restrict');
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
        
        // Drop foreign keys first if table exists
        if (Schema::hasTable('offices')) {
            Schema::table('offices', function (Blueprint $table) {
                // Use array form to avoid errors if FK names vary by platform
                if (Schema::hasColumn('offices', 'office_types_id')) {
                    $table->dropForeign(['office_types_id']);
                }
                if (Schema::hasColumn('offices', 'provinces_id')) {
                    $table->dropForeign(['provinces_id']);
                }
            });

            Schema::dropIfExists('offices');
        }

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View Office',
                'Store Office',
                'Update Office',
                'Delete Office'
            ])
            ->delete();
        
        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
