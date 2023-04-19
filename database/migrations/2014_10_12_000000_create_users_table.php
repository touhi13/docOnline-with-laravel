<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('fname')->nullable();
            $table->string('lnmae')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('dateOfbirth')->nullable();
            $table->string('designation')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('photo')->nullable();
            $table->text('aboutMe')->nullable();
            $table->text('services')->nullable();
            $table->text('specialization')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
