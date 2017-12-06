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
            $table->boolean('original')->nullable();
            $table->integer('category_id');
            $table->integer('user_id');
            //social-shares
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('favorites', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('user_id');
        });

        Schema::create('votes', function (Blueprint $table) {
            $table->integer('post_id');
            $table->integer('user_id');
            $table->tinyInteger('vote');
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
