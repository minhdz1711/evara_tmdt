<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('title',191);
            $table->string('slug',191);
            $table->text('content')->nullable();
            $table->text('overview')->nullable();
            $table->string('images', 191)->nullable();
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->unsignedTinyInteger('is_sort')->default(1);
            $table->unsignedTinyInteger('is_hot')->default(0);
            $table->unsignedBigInteger('id_user')->default(0)->unsigned();
            $table->bigInteger('view')->nullable()->default(0);
            $table->unsignedBigInteger('is_index')->default(0);
            $table->string('cate_product_id')->nullable();
            $table->string('id_tag')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['title', 'slug']);
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
        Schema::dropIfExists('posts');
    }
}
