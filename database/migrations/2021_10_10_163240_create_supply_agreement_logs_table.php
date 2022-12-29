<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateSupplyAgreementLogsTable extends Migration {

	public function up()
	{
		Schema::create('supply_agreement_logs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('fk_bids_id');
			$table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('supply_agreement_logs');
	}
}