<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddActiveColumnsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds an `active` boolean column to a list of tables and backfills
     * its value from `is_active` when present.
     *
     * @return void
     */
    public function up()
    {
        $tables = [
            'request_types',
            'categories',
            'sub_categories',
            'priority_levels',
            'statuses',
            'media',
            'hosts',
            'divisions',
        ];

        foreach ($tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            if (! Schema::hasColumn($tableName, 'active')) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    $table->boolean('active')->default(true);
                });
            }

            // Backfill from is_active when present
            if (Schema::hasColumn($tableName, 'is_active')) {
                // Use a raw update to copy values efficiently
                DB::statement("UPDATE {$tableName} SET active = is_active WHERE active IS NULL");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = [
            'request_types',
            'categories',
            'sub_categories',
            'priority_levels',
            'statuses',
            'media',
            'hosts',
            'divisions',
        ];

        foreach ($tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            if (Schema::hasColumn($tableName, 'active')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('active');
                });
            }
        }
    }
}
