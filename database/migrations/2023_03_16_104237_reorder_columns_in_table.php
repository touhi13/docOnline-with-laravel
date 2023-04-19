<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReorderColumnsInTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultation_schedule', function (Blueprint $table) {
            $table->decimal('first_consultation_fee', 8, 2)->before('created_at')->change();
            $table->decimal('follow_up_fee', 8, 2)->before('first_consultation_fee')->change();
            $table->decimal('discount', 5, 2)->before('follow_up_fee')->change();
            $table->date('discount_start_date')->before('discount')->change();
            $table->date('discount_end_date')->before('discount_start_date')->change();
            $table->string('currency', 10)->before('discount_end_date')->change();
            $table->integer('consultancy_duration')->before('currency')->change();
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
            //
        });
    }
}
