<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_trash')->default(1);
            $table->boolean('is_hot')->default(0);
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();

            $table->integer('boost')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->integer('visibility')->unsigned()->default(1);

            $table->string('title', 255);
            $table->string('slug', 255)->nullable();
            $table->string('subtitle', 255)->nullable();
            $table->string('facebook_title', 255)->nullable();
            $table->string('meta_title', 255)->nullable();


            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('filename')->nullable();
            $table->text('raw')->nullable();

            $table->text('facebook_description')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('facebook_image')->nullable();

            $table->index(['id', 'slug']);
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
