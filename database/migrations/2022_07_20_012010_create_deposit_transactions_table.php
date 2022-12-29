<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_farmer_request_id')->unsigned()->nullable();
			$table->foreign('admin_farmer_request_id')->references('id')->on('admin_farmer_requests')->onDelete('cascade');

            $table->integer('mapped_transaction_id')->unsigned()->nullable();
			$table->foreign('mapped_transaction_id')->references('id')->on('mapped_transactions')->onDelete('cascade');

            $table->integer('approved_qty');
            $table->double('amount');
            $table->string('status')->default('for_delivery'); // for_delivery, delivered
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
        Schema::dropIfExists('deposit_transactions');
    }
}
