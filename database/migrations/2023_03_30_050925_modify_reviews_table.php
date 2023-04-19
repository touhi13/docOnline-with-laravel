<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('rname');
            $table->dropColumn('rdescription');
            $table->dropColumn('ratting');
            // add more columns to drop here

            //
            $table->unsignedBigInteger('doctor_id')->after('id')->nullable()->default(null);
            $table->unsignedBigInteger('patient_id')->after('doctor_id')->nullable()->default(null);
            $table->unsignedBigInteger('appointment_id')->after('patient_id')->nullable()->default(null);
            $table->integer('rating')->after('appointment_id')->nullable()->default(null);
            $table->text('comment')->after('rating')->nullable()->default(null);
    
            // Add foreign key constraints
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('rname');
            $table->string('rdescription');
            $table->string('ratting');

            //
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['appointment_id']);
            $table->dropColumn('doctor_id');
            $table->dropColumn('patient_id');
            $table->dropColumn('appointment_id');
            $table->dropColumn('rating');
            $table->dropColumn('comment');
        });
    }
}
