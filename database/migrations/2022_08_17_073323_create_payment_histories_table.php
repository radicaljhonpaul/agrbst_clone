<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();

            $table->integer('mapped_transaction_id')->unsigned()->nullable();
			$table->foreign('mapped_transaction_id')->references('id')->on('mapped_transactions')->onDelete('set null');
            
            $table->double('amount', 8,2)->nullable();
            $table->string('payment_method'); //cash, gcash, maya, bank
            $table->string('reference_no'); //cash, gcash, maya, bank
            $table->string('remarks'); //partial, full
            $table->string('status')->default('pending'); //pending, paid, cancelled
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
        Schema::dropIfExists('payment_histories');
    }
}
