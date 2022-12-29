<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantingDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planting_data', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('crop_id')->unsigned()->nullable();
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

            $table->date('planting_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planting_data');
    }
}
