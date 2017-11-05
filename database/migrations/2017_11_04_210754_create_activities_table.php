<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');

            // Foreign key 
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->bigInteger('comment_id')->nullable();
            $table->foreign('comment_id')->references('id')->on('comments');
            $table->bigInteger('like_id')->nullable();
            $table->foreign('like_id')->references('id')->on('likes');

            $table->string('type');
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
        Schema::dropIfExists('activities');
    }
}
