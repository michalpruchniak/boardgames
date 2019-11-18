<?php

use Illuminate\Support\Facades\Schema;
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
          $table->string('name')->unique();
          $table->string('email')->unique();
          $table->string('password');
          $table->integer('gender')->nullable();
          $table->date('DOB')->nullable();
          $table->boolean('dobvisible')->nullable()->dafault(1);
          $table->text('description')->nullable();
          $table->integer('mylist')->default(1);
          $table->boolean('layoutvisible')->default(1)->nullable();
          $table->string('avatar')->nullable();
          $table->string('slug')->unique();
          $table->boolean('admin')->default(0);
          $table->boolean('moderator')->default(0);
          $table->boolean('bloger')->default(0);
          $table->boolean('publisher')->default(0);
          $table->boolean('ban')->default(0);
          $table->boolean('active')->default(1);
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
