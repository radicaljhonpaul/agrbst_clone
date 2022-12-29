<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropsTable extends Migration {

	public function up()
	{
		Schema::create('crops', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255)->nullable();
			// $table->float('qty')->nullable();
			// $table->string('unit', 50)->nullable();
			$table->string('seasonality', 255)->nullable();
			$table->string('crop_type', 50);
			$table->integer('successive'); // 1 = true, 0 = false
			$table->integer('no_of_weeks')->nullable(); // if successive is true
			$table->string('image_path', 100)->nullable();

			
		});
	}

	public function down()
	{
		Schema::drop('crops'); 
	}
}