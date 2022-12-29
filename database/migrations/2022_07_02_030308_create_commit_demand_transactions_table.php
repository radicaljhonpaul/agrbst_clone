<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitDemandTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commit_demand_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('demand_id')->unsigned()->nullable();
			$table->foreign('demand_id')->references('id')->on('demands')->onDelete('cascade');

            $table->integer('commit_id')->unsigned()->nullable();
			$table->foreign('commit_id')->references('id')->on('commits')->onDelete('cascade');

            $table->integer('mapped_transaction_id')->unsigned()->nullable();
            $table->foreign('mapped_transaction_id')->references('id')->on('mapped_transactions')->onDelete('cascade');

            $table->integer('approved_qty')->nullable();
            $table->double('amount_receivable', 8,2)->nullable(); //receivables ni farmer, payables ni agrihub (FGP), ang status sa payment kay naa tanan sa mapped transactions
            $table->integer('excess_qty')->nullable(); // qty nga wala na approve sa gi commit ni farmer
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commit_demand_transactions');
    }
}
