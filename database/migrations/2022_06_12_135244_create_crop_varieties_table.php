<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('crop_varieties', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 255);

			
			$table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

			
		});
	}

	public function down()
	{
		Schema::drop('crop_varieties');
	}
}
