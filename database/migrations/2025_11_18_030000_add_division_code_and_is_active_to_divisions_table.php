<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDivisionCodeAndIsActiveToDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('divisions')) {
            Schema::table('divisions', function (Blueprint $table) {
                if (!Schema::hasColumn('divisions', 'division_code')) {
                    $table->string('division_code', 100)->nullable()->after('name');
                }
                if (!Schema::hasColumn('divisions', 'is_active')) {
                    $table->boolean('is_active')->default(true)->after('division_code');
                }
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
        if (Schema::hasTable('divisions')) {
            Schema::table('divisions', function (Blueprint $table) {
                if (Schema::hasColumn('divisions', 'is_active')) {
                    $table->dropColumn('is_active');
                }
                if (Schema::hasColumn('divisions', 'division_code')) {
                    $table->dropColumn('division_code');
                }
            });
        }
    }
}
