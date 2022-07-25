<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('display_name')->nullable();
            $table->string('username', 191);
            $table->string('email', 191);
            $table->string('phone', 191);
            $table->string('password', 191);
            $table->string('address', 191)->nullable();
            $table->string('images', 191)->nullable();
            $table->bigInteger('gender')->nullable();
            $table->bigInteger('is_active')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->unique(['username', 'email', 'phone']);
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
        Schema::dropIfExists('memberships');
    }
}
