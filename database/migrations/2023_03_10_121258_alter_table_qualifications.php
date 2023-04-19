<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableQualifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualifications', function (Blueprint $table) {
            $table->string('institute_name')->after('title')->nullable()->default(null);
            $table->string('institute_location')->after('institute_name')->nullable()->default(null);
            $table->string('passing_year')->after('institute_location')->nullable()->default(null);
            $table->string('duration')->after('passing_year')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualifications', function (Blueprint $table) {
            $table->dropColumn(['institute_name', 'institute_location', 'passing_year', 'duration']);
        });
    }
}