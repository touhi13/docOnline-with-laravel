<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('fname', 'first_name');
            $table->renameColumn('lname', 'last_name');
            $table->renameColumn('dateOfbirth', 'date_of_birth');

            $table->dropColumn('aboutMe');
            $table->dropColumn('services');
            $table->dropColumn('designation');
            $table->dropColumn('specialization');
            $table->dropColumn('is_admin');

            $table->tinyInteger('status')->default(0);
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
            $table->renameColumn('first_name', 'fname');
            $table->renameColumn('last_name', 'lnmae');
            $table->renameColumn('date_of_birth', 'dateOfbirth');

            $table->text('aboutMe')->nullable();
            $table->text('services')->nullable();
            $table->text('specialization')->nullable();
            $table->string('designation')->nullable();
            $table->boolean('is_admin')->nullable();

            $table->dropColumn('status');

        });
    }
}
