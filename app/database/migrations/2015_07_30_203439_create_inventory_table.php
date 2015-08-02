<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventory', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('product_id');
			$table->string('eng_no');
			$table->string('chs_no');
			$table->enum('is_sell',array(1,0));
			$table->string('color');
			$table->integer('quantity');
			$table->string('buy_rate');
			$table->string('sell_rate');
			$table->string('img');
			$table->string('item_no');
			$table->string('supplyir_id');
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
		Schema::drop('inventory');
	}

}
