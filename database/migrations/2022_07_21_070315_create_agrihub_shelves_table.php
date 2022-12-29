<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgrihubShelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agrihub_shelves', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('deposit_transaction_id')->unsigned()->nullable();
			$table->foreign('deposit_transaction_id')->references('id')->on('deposit_transactions')->onDelete('cascade');

            $table->integer('shelf_life_id')->unsigned()->nullable();
			$table->foreign('shelf_life_id')->references('id')->on('shelf_lives')->onDelete('cascade');

            $table->integer('qty');
            $table->integer('remaining_qty');
            $table->timestamp('date_acquired');
            $table->date('salable_until');
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
        Schema::dropIfExists('agrihub_shelves');
    }
}
