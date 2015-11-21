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
			->select('moto_sold.id','moto_sold.price','moto_sold.paid','inventory.eng_no','inventory.chs_no','moto_sold.due','moto_sold.sold_date','moto_sold.payment_status','customars.first_name','customars.last_name','product.product_name')
			->whereBetween('sold_date',array($to,$form))->get();
		$op=[];
		foreach($data as $mata){
			$op[] = [
				$mata->id,
				$mata->first_name." ".$mata->last_name,
				$mata->product_name,
				$mata->eng_no,
				$mata->chs_no,
				$mata->payment_status,
				$mata->price,
				$mata->paid,
				$mata->due,
				$mata->sold_date,
				"puck"
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
			'sold_date' 		=>	$dateX->year."-".$dateX->month."-".$dateX->day,
			'vat' 				=> $input['frm_payVat'],
			'bank_int'			=> $input['frm_payInt'],
			'total_billed'		=> $input['total_bill'],
			'ref_id'			=> $input['ref_id']

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
						'sold_info' 	=> [
							'id' 			=> $sold->id,
							'moto_price'	=> $sold->price,
							'vat'			=> $sold->vat,
							'bank_int'		=> $sold->bank_int,
							'sold_date'		=> $sold->sold_date,
							'total_billed'	=> $sold->total_billed,
							'installments'	=> $sold->installments,
							'paid'			=> $sold->paid,
							'due'			=> $sold->due
						],
						'paid_id' 	=> $paid->id
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
				'rate'			=> $input['frm_inst_rate'],
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
					'sold_info' 	=> [
						'id' 			=> $sold->id,
						'moto_price'	=> $sold->price,
						'vat'			=> $sold->vat,
						'bank_int'		=> $sold->bank_int,
						'sold_date'		=> $sold->sold_date,
						'total_billed'	=> $sold->total_billed,
						'paid'			=> $sold->paid,
						'due'			=> $sold->due,
						'total_inst'	=> $setLoan->total_inst,
						'rate'			=> $setLoan->rate
					],
					'paid_id' 		=> $paid->id,
					'loan_id'		=> $setLoan->id
				],
				'massage' => 'Success to payment',
				'status' => 1
			];
		}
	}


	/**
	 * Installments the Management
	 *
	 */

	public function loanInfo(){
		$info = DB::table('car_loan')
			->join('moto_sold','moto_sold.id','=','car_loan.sold_id')
			->join('inventory','inventory.id','=','moto_sold.inv_id')
			->join('product','product.id','=','inventory.product_id')
			->join('customars','customars.id','=','moto_sold.cus_id')
			->select('car_loan.id','customars.first_name','moto_sold.cus_id',
				'product.product_name','car_loan.current_due','car_loan.rate','car_loan.next_pay_date',
				'car_loan.current_inst','moto_sold.sold_date')->get();
		$op = [];
		foreach($info as $list){
			$op[] = [$list->id,$list->first_name." ( ".$list->cus_id." )",$list->product_name,$list->current_due,$list->rate,$list->next_pay_date,$list->current_inst,$list->sold_date,"Action"];
		}
		return ['data' => $op];
	}

	public function getInfo($id){
		return Loan::find($id);
	}

	public function payInstallment(){
		$input = Input::all();
		$sold_info = DB::table('car_loan')->join('moto_sold','moto_sold.id','=','car_loan.sold_id')
			->where('car_loan.id',$input['loan_id_hd'])
			->select('car_loan.id','car_loan.sold_id','moto_sold.cus_id',
				'car_loan.current_inst','car_loan.current_paid','car_loan.current_due','car_loan.next_pay_date')
			->first();
		$payment = [
			'car_sold_id' 	=> $sold_info->sold_id,
			'cus_id' 		=> $sold_info->cus_id,
			'paid' 			=> $input['inst_payTotal'],
			'interest'		=> 0,
			'due_date' 		=> $input['inst_Paydate'],
			'comment' 		=> "Instalment pay on $sold_info->id"
		];
		$nexDate = \Carbon\Carbon::parse($sold_info->next_pay_date)->addMonth();
		$update = [
			'current_inst' => $sold_info->current_inst + 1,
			'current_paid' => $sold_info->current_paid + $input['inst_payAmount'],
			'current_due' => $sold_info->current_due - $input['inst_payAmount'],
			'next_pay_date' => $nexDate->year."-".$nexDate->month."-".$nexDate->day
		];
		$paid = CusPay::create($payment);
		if($paid->exists){
			$updateX = DB::table('car_loan')->where('id',$input['loan_id_hd'])
				->update($update);
			if($updateX){
				return ['success'=>1,'error'=>0];
			} else {
				return ['success'=>0,'error'=>1];
			}
		} else {
			return ['success'=>0,'error'=>1];
		}
	}

}
