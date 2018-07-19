<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();

            $table->integer('boost')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->integer('visibility')->unsigned()->nullable()->default(1);
            $table->integer('direction')->unsigned()->nullable()->default(1);

            $table->string('title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('slug')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('layout')->nullable();

            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('filename')->nullable();
            $table->text('extra_filename')->nullable();

            $table->string('facebook_title')->nullable();
            $table->text('facebook_description')->nullable();
            $table->text('facebook_image')->nullable();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
