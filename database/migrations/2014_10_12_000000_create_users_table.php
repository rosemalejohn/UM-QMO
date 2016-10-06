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
            $table->increments('id');
            $table->string('name');
            $table->string('id_number')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('position');
            $table->integer('department_id')->unsigned();
            $table->string('photo_url')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('type', ['admin', 'faculty', 'staff', 'standard']);
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
