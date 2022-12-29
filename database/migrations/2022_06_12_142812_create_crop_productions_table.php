<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('crop_productions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			
			$table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

			$table->float('dr', 10,2);
			$table->float('dh', 10,2);
			$table->integer('maturity_from');
			$table->integer('maturity_to');
			$table->string('harvesting', 255);
			$table->bigInteger('qty_hills');

			
		});
	}

	public function down()
	{
		Schema::drop('crop_productions');
	}
}
