<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191);
            $table->string('slug', 191);
            $table->text('overview')->nullable();
            $table->string('cat_type')->default('post');
            $table->string('images', 191)->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->unsignedTinyInteger('is_hot')->default(0);
            $table->unsignedTinyInteger('is_home')->default(0);
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
        Schema::dropIfExists('categories');
    }
}
