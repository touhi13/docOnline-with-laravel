<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultToTimeSlotsInConsultationScheduleTable extends Migration
{
    public function up()
    {
        Schema::table('consultation_schedule', function (Blueprint $table) {
            $table->json('time_slots')->default('[]')->change();
        });
    }

    public function down()
    {
        Schema::table('consultation_schedule', function (Blueprint $table) {
            $table->json('time_slots')->change();
        });
    }
}