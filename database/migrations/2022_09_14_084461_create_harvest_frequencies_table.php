<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarvestFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvest_frequencies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('harvest_data_id')->unsigned()->nullable();
            $table->foreign('harvest_data_id')->references('id')->on('harvest_data')->onDelete('cascade');
            
            $table->integer('week_no')->nullable(); // suggestion to farmer
            $table->date('harvest_date_from')->nullable(); // suggestion to farmer
            $table->date('harvest_date_to')->nullable(); // suggestion to farmer
            $table->integer('forcasted_harvest_qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harvest_frequencies');
    }
}
