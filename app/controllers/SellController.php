<?php

class SellController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$input = Input::all();
		$dateX = \Carbon\Carbon::now();
		$data = [
			'price'				=>	$input['frm_payable'],
    		'payment_status'	=>	$input['payment_status'],
    		'paid'				=>	$input['frm_ammount'],
    		'due'				=>	$input['frm_due'],
    		'installments'		=>	$input['frm_inst_no'],
    		//''	=>	$input['frm_inst_rate'],
    		'cus_id'			=>	$input['cus_id'],
    		'inv_id'			=>	$input['inv_id'],
			'sold_date' 		=>	$dateX->year."-".$dateX->month."-".$dateX->day
		];
		$sold = Sell::create($data);
		$update = DB::table('inventory')->where('id','=',$sold->inv_id)->update(array('is_sell' => 1));
		if($sold->exists){
			if($sold->payment_status == 'cash'){
				$payment = [
					'car_sold_id' 	=> $sold->id,
					'cus_id' 		=> $sold->cus_id,
					'paid' => $sold->paid,
					'interest'	=> 0,
					'due_date' => $sold->sold_date,
					'comment' => 'sold with cash'
				];
				$paid = CusPay::create($payment);
				print_r($paid);
			} else {

			}
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
