<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductBuyInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pro_buy_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('supplier_id');
			$table->string('comment');
			$table->double('ammount');
			$table->double('pay');
			$table->double('due');
			$table->date('date');
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
		Schema::drop('pro_buy_info');
	}

}
