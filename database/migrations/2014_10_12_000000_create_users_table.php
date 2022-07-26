<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('display_name', 191);
            $table->string('username', 191);
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            $table->bigInteger('position');
            $table->string('phone', 191)->nullable();
            $table->bigInteger('is_active')->default(1);
            $table->string('images', 191)->nullable();
            $table->bigInteger('gender')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
