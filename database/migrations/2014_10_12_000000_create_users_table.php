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
            $table->boolean('is_ban')->nullable()->default(0);
            $table->boolean('is_active')->nullable()->default(0);
            $table->boolean('is_trash')->nullable()->default(1);
            $table->integer('role')->unsigned()->nullable();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('short_description')->nullable();
            $table->text('filename')->nullable();
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
