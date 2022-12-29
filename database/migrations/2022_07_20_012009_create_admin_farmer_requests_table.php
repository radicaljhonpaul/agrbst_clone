<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminFarmerRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_farmer_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('from_user')->unsigned()->nullable();
			$table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');

            $table->integer('to_user')->unsigned()->nullable();
			$table->foreign('to_user')->references('id')->on('users')->onDelete('cascade');

            $table->integer('crop_id')->unsigned()->nullable();
			$table->foreign('crop_id')->references('id')->on('crops')->onDelete('cascade');

            $table->integer('variety_id')->unsigned()->nullable();
			$table->foreign('variety_id')->references('id')->on('crop_varieties')->onDelete('cascade');

            $table->integer('class_id')->unsigned()->nullable();
			$table->foreign('class_id')->references('id')->on('crop_classes')->onDelete('cascade');

            $table->string('route');
            $table->integer('requested_qty');
            $table->double('amount', 8,2);
            $table->string('status')->default('pending'); //approved, pending, denied
            $table->text('remarks')->nullable();
            $table->timestamps(); // created_at for date of request, Updated_at for date of approved.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_farmer_requests');
    }
}
