<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->integer('boost')->unsigned()->nullable();
            $table->integer('visibility')->unsigned()->default(1)->nullable();
            $table->string('short_description')->nullable();
            $table->text('filename')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->text('face_title')->nullable();
            $table->text('face_description')->nullable();

            $table->datetime('expires_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('pages');
    }
}
