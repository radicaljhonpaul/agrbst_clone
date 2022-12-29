<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuccessiveHarvestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('successive_harvests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('week');
            $table->integer('harvested_qty');
            $table->date('forecasted_harvested_date');

            $table->integer('commit_id')->unsigned()->nullable();
            $table->foreign('commit_id')->references('id')->on('commits')->onDelete('cascade');


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
        Schema::dropIfExists('successive_harvests');
    }
}
