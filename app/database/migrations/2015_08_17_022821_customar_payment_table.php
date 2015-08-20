<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomarPaymentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customar_payment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('car_sold_id');
			$table->integer('cus_id');
			$table->double('payment_ammount');
			$table->date('due_date');
			$table->date('next_date');
			$table->string('comment');
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
		Schema::drop('customar_payment');
	}

}
