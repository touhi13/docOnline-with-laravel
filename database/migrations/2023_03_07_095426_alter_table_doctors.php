<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableDoctors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->date('date_of_birth')->after('name')->nullable()->default(null);
            $table->unsignedBigInteger('district_id')->after('gender')->nullable()->default(null);
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('nid')->after('district_id')->nullable()->default(null);
            $table->string('regno')->after('nid')->nullable()->default(null);
            $table->string('phone')->after('profile_photo')->nullable()->default(null);
            $table->string('email')->after('phone')->unique()->nullable()->default(null);
            $table->string('password')->after('email')->nullable()->default(null);
            $table->boolean('is_doctor')->after('password')->default(false);
            $table->rememberToken()->after('is_doctor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['district_id']);
            $table->dropColumn(['date_of_birth', 'district_id', 'nid', 'regno', 'phone', 'email', 'password','remember_token']);
        });
    }
}