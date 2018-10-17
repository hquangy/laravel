<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_hot')->nullable()->default(0);
            $table->boolean('is_index')->nullable()->default(1);
            $table->boolean('is_trash')->nullable()->default(1);

            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('ancestor_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();

            $table->integer('boost')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->integer('visibility')->unsigned()->nullable()->default(1);
            $table->integer('direction')->unsigned()->nullable()->default(1);

            $table->string('title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('slug')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('layout')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('facebook_title')->nullable();

            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('facebook_description')->nullable();
            $table->text('filename')->nullable();
            $table->text('mobile_filename')->nullable();
            $table->text('facebook_filename')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['id','title','slug']);
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
        Schema::dropIfExists('categories');
    }
}
