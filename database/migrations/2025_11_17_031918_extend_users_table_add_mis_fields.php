<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtendUsersTableAddMisFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_number')->nullable()->after('uuid');
            $table->date('date_birth')->nullable()->after('last_name');
            $table->enum('sex', ['Male', 'Female'])->nullable()->after('date_birth');
            $table->boolean('is_pwd')->default(false)->after('sex');
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->string('designation')->nullable()->after('id_number');
            $table->unsignedBigInteger('client_types_id')->nullable();
            $table->unsignedBigInteger('offices_id')->nullable();
            $table->unsignedBigInteger('divisions_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'id_number',
                'date_birth',
                'sex',
                'is_pwd',
                'phone',
                'address',
                'designation',
                'client_types_id',
                'offices_id',
                'divisions_id',
            ]);
        });
    }
}
