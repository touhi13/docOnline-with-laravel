<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->decimal('first_consultation_fee', 8, 2)->nullable()->default(null);
            $table->decimal('follow_up_fee', 8, 2)->nullable()->default(null);
            $table->decimal('discount', 5, 2)->nullable()->default(null);
            $table->date('discount_start_date')->nullable()->default(null);
            $table->date('discount_end_date')->nullable()->default(null);
            $table->string('currency', 10)->nullable()->default(null);
            $table->integer('consultancy_duration')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['first_consultation_fee', 'follow_up_fee', 'discount', 'discount_start_date', 'discount_end_date', 'currency', 'consultancy_duration']);
        });
    }
}