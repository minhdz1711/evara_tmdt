<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',191);
            $table->bigInteger('comment_product_id')->unsigned();
            $table->text('content');
            $table->string('images', 191)->nullable();
            $table->timestamp('date');
            $table->unsignedTinyInteger('is_active')->default(1);
            $table->timestamps();
            $table->foreign('comment_product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
