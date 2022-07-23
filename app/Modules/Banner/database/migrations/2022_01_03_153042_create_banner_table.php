<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191)->unique();
            $table->string('images', 191)->nullable();
            $table->string('link_banner', 191)->nullable();
            $table->bigInteger('position')->default(0);
            $table->bigInteger('order')->default(0);
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('id_user')->default(0)->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('banners');
    }
}
