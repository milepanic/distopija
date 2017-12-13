<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('description')->nullable();
            $table->boolean('admin')->nullable();
            $table->integer('points')->default(0);
            $table->date('banned_until')->nullable();
            $table->string('ban_message')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('subscription', function (Blueprint $table) {
            $table->integer('subscriber_id');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users', 'subscription');
    }
}
