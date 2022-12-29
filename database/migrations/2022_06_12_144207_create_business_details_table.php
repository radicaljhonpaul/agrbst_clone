<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('business_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();

			$table->integer('user_detail_id')->unsigned()->nullable();
			$table->foreign('user_detail_id')->references('id')->on('user_details')->onDelete('cascade');

			$table->string('business_name', 255)->nullable();
			$table->string('nature_of_business', 255)->nullable();
			$table->string('business_permit_no', 255)->nullable();
			$table->string('region', 100);
			$table->string('province', 100);
			$table->string('city', 100);
			$table->string('brgy', 100);
			$table->integer('long');
			$table->integer('lat');


			
		});
	}

	public function down()
	{
		Schema::drop('business_details'); 
	}
}
