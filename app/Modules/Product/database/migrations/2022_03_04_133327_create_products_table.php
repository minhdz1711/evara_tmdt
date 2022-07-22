<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191);
            $table->string('slug', 191);
            $table->text('content')->nullable();
            $table->text('overview')->nullable();
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('number_sell')->nullable()->default(0);
            $table->text('order')->nullable();
            $table->bigInteger('view')->nullable()->default(0);
            $table->string('brands_id')->nullable();
            $table->string('link_view')->nullable();
            $table->bigInteger('regular_price')->default(0);
            $table->bigInteger('sale_price')->default(0);
            $table->string('sku')->nullable();
            $table->string('images', 191)->nullable();
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->unsignedTinyInteger('is_instock')->default(1);
            $table->unsignedTinyInteger('is_hot')->default(0);
            $table->unsignedBigInteger('id_user')->default(0)->unsigned();
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
        Schema::dropIfExists('products');
    }
}
