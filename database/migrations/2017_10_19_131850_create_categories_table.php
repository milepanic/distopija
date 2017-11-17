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
            $table->tinyInteger('nsfw')->nullable();
            $table->tinyInteger('cover_box')->nullable(); //box koji prekriva punchline
            $table->tinyInteger('pictures')->nullable();
            $table->tinyInteger('videos')->nullable();
            // da li korisnici mogu postavljati viceve ili samo admini
            $table->tinyInteger('approved')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('category_user', function (Blueprint $table){
            $table->integer('category_id');
            $table->integer('user_id');
            $table->tinyInteger('blocked')->default(0);
            $table->tinyInteger('moderator')->default(0);

            //$table->primary(['category_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
