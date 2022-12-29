<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarvestDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvest_data', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('crop_id')->unsigned()->nullable();
            $table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

            $table->integer('commit_demand_transaction_id')->unsigned()->nullable();
            $table->foreign('commit_demand_transaction_id')->references('id')->on('commit_demand_transactions')->onDelete('cascade');

            $table->integer('planting_data_id')->unsigned()->nullable();
            $table->foreign('planting_data_id')->references('id')->on('planting_data')->onDelete('cascade');

            $table->string('harvest_data_type'); // farmer_input, commit
            $table->date('planting_date')->nullable(); // suggested planting date (automated) if from harvest_data_type == commit, user_input if harvest_data_type == farmer_input
            // $table->date('harvest_date_from');
            // $table->date('harvest_date_to');
            $table->integer('no_of_weeks');
            // $table->integer('forcasted_harvest');

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harvest_data');
    }
}
