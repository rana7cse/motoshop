<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CarLoanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_loan', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sold_id');
			$table->integer('loan_cat');
			$table->date('rpayment_start_data');
			$table->date('rpayment_end_date');
			$table->double('rpayment_ammount');
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
		Schema::drop('car_loan');
	}

}
