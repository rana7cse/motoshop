<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('address');
			$table->string('ref')->default('NA');
			$table->string('phone');
			$table->string('phone2');
			$table->string('email');
			$table->string('nid_no')->default('NA');
			$table->text('img');
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
		Schema::drop('customars');
	}

}
