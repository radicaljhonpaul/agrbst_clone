<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropProductionHarvestingModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('crop_production_harvesting_models', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('week_no');
			// to ask about double and expected value
			$table->double('value'); 

			$table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('crop_production_harvesting_models');
	}
}
