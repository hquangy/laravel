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
            $table->boolean('is_hot')->nullable()->default(0);
            $table->boolean('is_index')->nullable()->default(1);
            $table->boolean('is_trash')->nullable()->default(1);

            $table->integer('ancestor_category_id')->unsigned()->nullable();
            $table->integer('parent_category_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->tinyInteger('property_1')->unsigned()->nullable();
            $table->tinyInteger('property_2')->unsigned()->nullable();
            $table->tinyInteger('property_3')->unsigned()->nullable();

            $table->integer('boost')->unsigned()->nullable();
            $table->integer('order')->unsigned()->nullable();
            $table->tinyInteger('visibility')->unsigned()->nullable()->default(1);
            $table->double('price',10,1)->unsigned()->nullable();
            $table->double('min_price',10,1)->unsigned()->nullable();
            $table->double('max_price',10,1)->unsigned()->nullable();

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

            $table->datetime('expires_at')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('parent_category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('ancestor_category_id')->references('id')->on('categories')->onDelete('cascade');
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
