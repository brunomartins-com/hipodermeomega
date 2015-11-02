<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('babyName', 100);
            $table->date('babyBirthday');
            $table->string('babyGender', 10);
            $table->string('name', 100);
            $table->string('rg', 25);
            $table->string('cpf', 14)->unique();
            $table->string('address', 150);
            $table->string('gender', 10);
            $table->string('number', 10);
            $table->string('complement', 50);
            $table->string('district', 50);
            $table->string('state', 2);
            $table->integer('city');
            $table->string('phone', 14);
            $table->string('mobile', 15);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('token');
            $table->boolean('type');
            $table->boolean('active');
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
        Schema::drop('users');
    }
}
