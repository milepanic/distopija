<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->text('content');
            $table->tinyInteger('original')->nullable();
            $table->integer('category_id');
            $table->integer('user_id');
            //comments
            //social-shares
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('favorites')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('post_user_vote', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('user_id');
            $table->tinyInteger('vote')->nullable();
            // $table->tinyInteger('favorite')->nullable();
            $table->softDeletes();
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
