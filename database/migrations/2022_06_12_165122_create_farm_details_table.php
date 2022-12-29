<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('farm_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			
			$table->integer('user_detail_id')->unsigned()->nullable();
			$table->foreign('user_detail_id')->references('id')->on('user_details')->onDelete('cascade');

			$table->string('farm_name', 255);
			$table->float('farm_size', 10,2);
			$table->float('remaining_size', 10,2); // remaining farm size
			$table->string('region', 100);
			$table->string('province', 100);
			$table->string('city', 100);
			$table->string('brgy', 100);
			$table->string('long', 100)->nullable();
			$table->string('lat', 100)->nullable();

			
		});
	}

	public function down()
	{
		Schema::drop('farm_details');
	}
}
