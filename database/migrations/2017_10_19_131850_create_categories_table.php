<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->boolean('nsfw')->nullable();
            $table->boolean('cover_box')->nullable();
            $table->boolean('pictures')->nullable();
            $table->boolean('videos')->nullable();
            $table->boolean('mods_only')->nullable();
            $table->boolean('approved')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('category_user', function (Blueprint $table){
            $table->integer('category_id');
            $table->integer('user_id');
            $table->boolean('blocked')->nullable();
            $table->boolean('moderator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories', 'category_user');
    }
}
