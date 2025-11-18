<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveToOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('offices') && !Schema::hasColumn('offices', 'active')) {
            Schema::table('offices', function (Blueprint $table) {
                $table->boolean('active')->default(true)->after('name');
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
        if (Schema::hasTable('offices') && Schema::hasColumn('offices', 'active')) {
            Schema::table('offices', function (Blueprint $table) {
                $table->dropColumn('active');
            });
        }
    }
}
