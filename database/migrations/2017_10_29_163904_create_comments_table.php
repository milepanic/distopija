<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->text('comment');
            $table->integer('votes')->default(0);
            $table->integer('reply_id')->nullable();
            $table->integer('post_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('comment_user_vote', function (Blueprint $table) {
            $table->integer('comment_id');
            $table->integer('user_id');
            $table->TinyInteger('vote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments', 'comment_user_vote');
    }
}
