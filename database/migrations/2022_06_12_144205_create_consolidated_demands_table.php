<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidatedDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidated_demands', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

            $table->integer('variety_id')->unsigned()->nullable();
			$table->foreign('variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');

            $table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('crop_classes')->onDelete('cascade');

            $table->integer('price_id')->unsigned()->nullable();
			$table->foreign('price_id')->references('id')->on('crop_pricings')->onDelete('cascade');

            $table->string('pool_no')->unique();
            $table->double('consolidated_qty', 8,2);
            $table->double('consolidated_amount', 8,2);
            $table->date('date'); //delivery date
            $table->string('status'); // pooling, closed
            $table->timestamps();




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consolidated_demands');
    }
}
