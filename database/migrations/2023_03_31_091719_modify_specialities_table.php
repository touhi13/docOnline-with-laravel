<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySpecialitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialities', function (Blueprint $table) {
            $table->text('description')->nullable()->after('profession_name');
            $table->string('icon')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specialities', function (Blueprint $table) {
            $table->dropColumn(['description', 'icon']);
        });
    }
}
