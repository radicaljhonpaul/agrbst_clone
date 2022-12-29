<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCropPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crop_pricings', function (Blueprint $table) {
            $table->increments('id');
			$table->timestamps();
			$table->softDeletes();

            $table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

            $table->integer('variety_id')->unsigned()->nullable();
			$table->foreign('variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');
            
            $table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('crop_classes')->onDelete('cascade');

            $table->float('qty')->nullable();
			$table->string('unit', 50)->nullable();
			$table->float('fgp', 10,2);
			$table->float('smp', 10,2);

			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crop_pricings');
    }
}
