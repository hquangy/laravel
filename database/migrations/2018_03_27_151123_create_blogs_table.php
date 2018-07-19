<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('top_cat_id')->unsigned()->nullable();
            $table->integer('cat_id')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->integer('boost')->unsigned()->nullable();
            $table->integer('visibility')->unsigned()->default(1)->nullable();

            $table->string('title')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('face_title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('slug')->nullable();
            $table->string('short_description')->nullable();

            $table->text('filename')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('face_description')->nullable();

            $table->datetime('expires_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
