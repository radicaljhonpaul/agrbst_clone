<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->integer('consolidated_demand_id')->unsigned()->nullable();
			$table->foreign('consolidated_demand_id')->references('id')->on('consolidated_demands')->onDelete('set null');
            
            $table->integer('qty');
            $table->integer('commited_farm_size');
            $table->string('status')->default('pending'); //pending, approved, deny
            // $table->double('amount_receivable', 8,2)->nullable(); //to be transfer in commit_demand_transaction
            $table->integer('excess_qty')->nullable(); //to be transfer in commit_demand_transaction
            // $table->integer('amount');

            // $table->integer('farm_detail_id')->unsigned()->nullable();
            // $table->foreign('farm_detail_id')->references('id')->on('farm_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commits');
    }
}
