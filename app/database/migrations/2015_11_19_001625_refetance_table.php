<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefetanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('referance', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ref_name');
			$table->text('address');
			$table->string('thana');
			$table->string('zilla');
			$table->string('division');
			$table->string('country');
			$table->integer('contact');
			$table->integer('contact2');
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
		Schema::drop('referance');
	}

}
