<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
	{
		Schema::create('demands', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();

			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

			$table->integer('variety_id')->unsigned()->nullable();
			$table->foreign('variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');

			$table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('crop_classes')->onDelete('cascade');

			$table->integer('price_id')->unsigned()->nullable();
			$table->foreign('price_id')->references('id')->on('crop_pricings')->onDelete('cascade');

			$table->integer('mapped_transaction_id')->unsigned()->nullable();
			$table->foreign('mapped_transaction_id')->references('id')->on('mapped_transactions')->onDelete('cascade');
			
			$table->integer('consolidated_demand_id')->unsigned()->nullable();
			$table->foreign('consolidated_demand_id')->references('id')->on('consolidated_demands')->onDelete('cascade');
			
			$table->integer('qty');
			$table->integer('amount');
			$table->date('date'); // delivery date
			$table->integer('remaining_qty')->nullable();
			$table->string('status'); //on-going, closed, on-delivery, delivered, picked-up
		});
	}

	public function down()
	{
		Schema::drop('demands');
	}
}
