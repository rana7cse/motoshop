<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MotoSoldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('moto_sold', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inv_id');
			$table->integer('cus_id');
			$table->double('price');
			$table->date('sold_date');
			$table->date('payment_datePm');
			$table->double('payment_amountPm');
			$table->enum('payment_status',['cash','due']);
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
		Schema::drop('moto_sold');
	}

}
