<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('meetings')) {
            Schema::create('meetings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('request_number', 45)->comment('Unique request identifier');
                $table->unsignedBigInteger('requested_by')->nullable();
                $table->date('date_requested')->nullable();
                $table->string('topic')->comment('Meeting topic');
                $table->date('date_scheduled')->nullable();
                $table->time('time_start')->nullable();
                $table->time('time_end')->nullable();
                $table->unsignedBigInteger('hosts_id')->nullable();
                $table->unsignedBigInteger('statuses_id')->default(1);
                $table->text('meeting_details')->nullable();
                $table->unsignedBigInteger('generated_by')->nullable();
                $table->unsignedBigInteger('approved_by')->nullable();
                $table->softDeletes();
                $table->timestamps();

                // Indexes
                $table->unique('request_number', 'uk_meetings_request_number');
                $table->index('requested_by', 'idx_meetings_requested_by');
                $table->index('hosts_id', 'idx_meetings_hosts');
                $table->index('statuses_id', 'idx_meetings_statuses');
                $table->index('date_scheduled', 'idx_meetings_date_scheduled');

                // Foreign keys (if referenced tables exist)
                $table->foreign('requested_by', 'fk_meetings_requested_by')
                    ->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
                $table->foreign('hosts_id', 'fk_meetings_hosts')
                    ->references('id')->on('hosts')->onDelete('set null')->onUpdate('cascade');
                $table->foreign('statuses_id', 'fk_meetings_statuses')
                    ->references('id')->on('statuses')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign('generated_by', 'fk_meetings_generated_by')
                    ->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
                $table->foreign('approved_by', 'fk_meetings_approved_by')
                    ->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            });

            // Add fulltext index for topic (MySQL)
            try {
                DB::statement('ALTER TABLE meetings ADD FULLTEXT ft_topic (topic)');
            } catch (\Exception $e) {
                // ignore if not supported
            }

            // Insert permissions into the permissions table
            $permissions = [
                ['name' => 'View Meeting', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Store Meeting', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Update Meeting', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Delete Meeting', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ];

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
        Schema::dropIfExists('meetings');

        // Remove permissions
        DB::table('permissions')
            ->whereIn('name', [
                'View Meeting',
                'Store Meeting',
                'Update Meeting',
                'Delete Meeting'
            ])
            ->delete();
    }
}
