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

	/**
	 * ------- Buy Report Here -----------
	 * */

	public function buyReport(){
		$today = \Carbon\Carbon::now();
		$today = $today->year.'-'.$today->month.'-'.$today->day;
		$lastDay = \Carbon\Carbon::parse($today)->subDays(7);
		$lastDay = $lastDay->year.'-'.$lastDay->month.'-'.$lastDay->day;
		$all = DB::table('inventory')
			->join('product','product.id','=','inventory.product_id')
			->select('inventory.id','inventory.created_at','inventory.eng_no','inventory.chs_no','inventory.is_sell','inventory.color','inventory.sell_rate','product.product_name','product.model')
			->whereBetween('inventory.created_at',array($lastDay,$today))
			->get();
		$kopa = [
			'to' => $lastDay,
			'form' => $today,
			'data' => $all
		];
		return View::make('report.buy',compact('kopa'));
	}

	public function buyReportByDate(){
		$inputs = Input::all();
		$to = $inputs['form'];
		$form = $inputs['to'];
		$all = DB::table('inventory')
			->join('product','product.id','=','inventory.product_id')
			->select('inventory.id','inventory.created_at','inventory.eng_no','inventory.chs_no','inventory.is_sell','inventory.color','inventory.sell_rate','product.product_name','product.model')
			->whereBetween('inventory.created_at',array($to,$form))
			->get();
		$kopa = [
			'to' => $to,
			'form' => $form,
			'data' => $all
		];
		//print_r($kopa);
		return View::make('report.buy',compact('kopa'));
	}

	/**
	 * ------- Sell Report Here -----------
	 * */
	public function sellReport(){
		$today = \Carbon\Carbon::now();
		$today = $today->year.'-'.$today->month.'-'.$today->day;
		$lastDay = \Carbon\Carbon::parse($today)->subDays(7);
		$lastDay = $lastDay->year.'-'.$lastDay->month.'-'.$lastDay->day;
		$data = DB::table('moto_sold')
			->join('customars','moto_sold.cus_id','=','customars.id')
			->join('inventory','moto_sold.inv_id','=','inventory.id')
			->join('product','inventory.product_id','=','product.id')
			->select('moto_sold.id','moto_sold.price','moto_sold.paid','inventory.eng_no','inventory.chs_no','moto_sold.due','moto_sold.sold_date','moto_sold.payment_status','customars.first_name','customars.last_name','product.product_name')
			->whereBetween('sold_date',array($lastDay,$today))->get();
		$kopa = [
			'to' => $lastDay,
			'form' => $today,
			'data' => $data
		];
		return View::make('report.sell',compact('kopa'));
	}
}
