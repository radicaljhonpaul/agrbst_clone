<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('user_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();

			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->string('image_path', 100)->nullable();
			$table->string('fname', 50);
			$table->string('lname', 50);
			$table->string('sex', 10)->nullable();
			$table->date('bday');
			$table->string('phone', 11);   
			$table->string('region', 100);
			$table->string('province', 100);
			$table->string('city', 100);
			$table->string('address_line', 100)->nullable();
			$table->string('brgy', 100);
			$table->string('long', 100)->nullable();
			$table->string('lat', 100)->nullable();


			

		});
	}

	public function down()
	{
		Schema::drop('user_details');
	}
}
