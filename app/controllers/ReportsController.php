<?php

class ReportsController extends \BaseController {

	/**
	 * ------- Inventory Report Here -----------
	 * */

	public function inventory(){
		$report = DB::select(
			DB::raw("SELECT (SELECT product_name FROM product WHERE id=product_id) as product,count(product_id) as total FROM inventory WHERE is_sell = '0' GROUP BY product_id")
		);
		return View::make('report.inventory',compact('report'));
	}

	public function buyReport(){
		return View::make('report.buy');
	}
}
