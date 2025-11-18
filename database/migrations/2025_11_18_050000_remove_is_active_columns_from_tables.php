<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemoveIsActiveColumnsFromTables extends Migration
{
    /**
     * Run the migrations.
     *
     * Drops `is_active` from the list of tables where we've migrated to `active`.
     * This migration is safe-guarded with Schema::hasColumn checks.
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
            if (Schema::hasColumn($tableName, 'is_active')) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    // Drop the column if the driver supports it; Schema::hasColumn guards existence.
                    $table->dropColumn('is_active');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * Re-adds `is_active` (default true) and backfills its value from `active` when present.
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
            if (!Schema::hasColumn($tableName, 'is_active')) {
                Schema::table($tableName, function (Blueprint $table) {
                    // Add back as boolean with default true. If `active` exists we will backfill below.
                    $table->boolean('is_active')->default(true)->after('active');
                });

                if (Schema::hasColumn($tableName, 'active')) {
                    // Copy values from `active` to `is_active` to restore previous state.
                    DB::statement("UPDATE {$tableName} SET is_active = active WHERE is_active IS NULL");
                }
            }
        }
    }
}
