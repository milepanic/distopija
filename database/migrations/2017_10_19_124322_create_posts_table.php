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
            $table->string('category');
            $table->integer('user_id');
            //comments
            //social-shares
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('favorites')->default(0);
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
