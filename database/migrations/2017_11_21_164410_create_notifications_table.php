<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');

            $table->uuid('owner_id');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->uuid('actor_id');
            $table->foreign('actor_id')->references('id')->on('users');

            $table->bigInteger('post_id')->nullable();
            $table->foreign('post_id')->references('id')->on('posts');

            $table->string('action');
            $table->boolean('read');

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
        Schema::dropIfExists('notifications');
    }
}
