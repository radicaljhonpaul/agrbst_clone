<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnhandTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onhand_transactions', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

            $table->integer('variety_id')->unsigned()->nullable();
			$table->foreign('variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');

            $table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('crop_classes')->onDelete('cascade');

            $table->integer('mapped_transaction_id')->unsigned()->nullable();
			$table->foreign('mapped_transaction_id')->references('id')->on('mapped_transactions')->onDelete('cascade');

            $table->date('date');
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
        Schema::dropIfExists('onhand_transactions');
    }
}
