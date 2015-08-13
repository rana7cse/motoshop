<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supplier', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('supp_name',200);
			$table->string('supp_type',50);
			$table->text('supp_add');
			$table->string('supp_mgm',200);
			$table->string('contact_f',14);
			$table->string('contact_s',14);
			$table->string('email',50);
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
		Schema::drop('supplier');
	}

}
