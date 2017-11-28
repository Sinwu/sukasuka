<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_params', function (Blueprint $table) {
            $table->increments('id');

            // Foreign key 
            $table->integer('apps_id');
            $table->foreign('apps_id')->references('id')->on('apps');
 
            $table->string('type');
            $table->string('name');
            $table->string('value');

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
        Schema::dropIfExists('app_params');
    }
}
