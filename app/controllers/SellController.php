<?php

class SellController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($to,$form)
	{
		$data = DB::table('moto_sold')
			->join('customars','moto_sold.cus_id','=','customars.id')
			->join('inventory','moto_sold.inv_id','=','inventory.id')
			->join('product','inventory.product_id','=','product.id')
			->select('moto_sold.id','moto_sold.price','moto_sold.paid','moto_sold.due','moto_sold.sold_date','moto_sold.payment_status','customars.first_name','customars.last_name','product.product_name')
			->whereBetween('sold_date',array($to,$form))->get();
		$op=[];
		foreach($data as $mata){
			$op[] = [
				$mata->id,
				$mata->first_name." ".$mata->last_name,
				$mata->product_name,
				$mata->payment_status,
				$mata->price,
				$mata->paid,
				$mata->due,
				$mata->sold_date
			];
		}
		return ['data'=>$op];
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
		$p_status = $input['payment_status'];
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

		if($p_status == 'cash'){
			if($data['due'] != 0){
				return [
					'data' => 0,
					'massage' => 'Please paid full amount or choose installment',
					'status' => 0
				];
			} else {
				$sold = Sell::create($data);
				$payment = [
					'car_sold_id' 	=> $sold->id,
					'cus_id' 		=> $sold->cus_id,
					'paid' 			=> $sold->paid,
					'interest'		=> 0,
					'due_date' 		=> $sold->sold_date,
					'comment' 		=> 'sold with cash'
				];
				$update = DB::table('inventory')->where('id','=',$sold->inv_id)
					->update(['is_sell'=>'1']);
				$paid = CusPay::create($payment);
				return [
					'data' => [
						'sold_id' 	=> $sold->id,
						'paid_id' 	=> $paid->id,
						'payment' 	=> [
							'date' 		=> 	$sold->sold_date,
							'billed' 	=>	$sold->price,
							'paid' => $sold->paid,
							'due' => $sold->due
						]
					],
					'massage' => 'Success to payment',
					'status' => 1
				];
			}
		} else {
			$sold = Sell::create($data);
			$dateLast = \Carbon\Carbon::parse($sold->sold_date)->addMonths($data['installments']);
			$dateNext = \Carbon\Carbon::parse($sold->sold_date)->addMonth();
			$payment = [
				'car_sold_id' 	=> $sold->id,
				'cus_id' 		=> $sold->cus_id,
				'paid' 			=> $sold->paid,
				'interest'		=> 0,
				'due_date' 		=> $sold->sold_date,
				'comment' 		=> 'sold with due'
			];
			$loan = [
				'sold_id'		=> $sold->id,
				'rate'			=> $sold->price,
				'total_inst'	=> $sold->installments,
				'current_inst' 	=> 1,
				'current_paid'	=> $sold->paid,
				'current_due'	=> $sold->due,
				'next_pay_date' => $dateNext->year."-".$dateNext->month."-".$dateNext->day,
				'end_date'		=> $dateLast->year."-".$dateLast->month."-".$dateLast->day
			];
			$setLoan = Loan::create($loan);
			$update = DB::table('inventory')->where('id','=',$sold->inv_id)
				->update(['is_sell'=>'1']);
			$paid = CusPay::create($payment);
			return [
				'data' => [
					'sold_id' => $sold->id,
					'paid_id' => $paid->id,
					'loan_id' => $setLoan->id
				],
				'massage' => 'Success to payment',
				'status' => 1
			];
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
