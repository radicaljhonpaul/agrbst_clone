<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarketingAgreementLogsTable extends Migration {

	public function up()
	{
		Schema::create('marketing_agreement_logs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->tinyInteger('fk_demands_id');
			$table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('marketing_agreement_logs');
	}
}