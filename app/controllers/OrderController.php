<?php

class OrderController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = DB::table('pro_buy_info')
			->join('supplier','supplier.id','=','pro_buy_info.supplier_id')
			->select('pro_buy_info.id','supplier.supp_name','pro_buy_info.comment','pro_buy_info.ammount','pro_buy_info.date')
			->get();
		$op = [];
		foreach($orders as $order){
			$op[] = array($order->id,$order->supp_name,$order->comment,$order->ammount,$order->date,'action');
		}

		return json_encode(array('data' => $op));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$input = Input::all();

		$data = array(
			'supplier_id' 	=>	$input['newOrderSupp'] ,
			'comment' 		=>	$input['newOrderComment'],
			'ammount' 		=>	$input['newOrderAmmount'],
			'pay' 			=>	$input['newOrderPayment'],
			'due'			=>	$input['newOrderDue'],
			'date' 			=>	$input['newOrdDate']
		);

		$insert = Order::create($data);
		if($insert->exists && $data['pay'] > 0){

			$payment = array(
				'supplier_id' 	=> $insert->supplier_id,
				'order_id'		=> $insert->id,
				'comment'		=> $insert->comment,
				'ammount'		=> $insert->ammount,
				'date'			=> $insert->date
			);
			$make = PaySupp::create($payment);
			if($make->exists){
				echo json_encode(array('order'=>1,'payment'=>1,'error'=>0,'id'=>$insert->id));
			};

		} elseif($insert->exists) {

			echo json_encode(array('order'=>1,'payment'=>0,'error'=>0, 'id'=>$insert->id));

		} else {

			echo json_encode(array('order'=>1,'payment'=>0,'error'=>1));

		};
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Order::find($id);
	}


	/**
	 * ------------ Payment Make on a Order ----------.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function orderPay()
	{
		$input = Input::all();
		$payment = array(
			'supplier_id' 	=> $input['payOrderSuppId'],
			'order_id'		=> $input['payOrderId'],
			'comment'		=> "Paid on Order-".$input['payOrderId'],
			'ammount'		=> $input['payOrderPay'],
			'date'			=> $input['payOrderDate']
		);
		if($input['payOrderPay']>0){
			$order = PaySupp::create($payment);
			if($order->exists){
				$upDue = Order::where('id','=',$input['payOrderId'])
					->update(
						array(
							'due' => $input['payOrderDue'],
							'pay' => $input['payOrderCurPay']
						)
					);
				if($upDue){
					return json_encode(array('pay'=>1,'order'=>1,'error'=>0));
				}else{
					return json_encode(array('pay'=>1,'order'=>0,'error'=>0));
				}
			}
		}else{
			return json_encode(array('pay'=>0,'order'=>0,'error'=>1));
		}
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
	public function allPayment(){
		$all = DB::table('supplier_payment')
			->join('supplier','supplier_payment.supplier_id','=','supplier.id')
			->select('supplier_payment.id','supplier.supp_name','supplier_payment.order_id','supplier_payment.ammount','supplier_payment.date')->get();
		$op = [];
		foreach($all as $data){
			$op[] = array($data->id,$data->supp_name,$data->order_id,$data->ammount,$data->date,"Action");
		}
		return array('data'=>$op);
	}


	public function destroy($id)
	{
		$del = Order::find($id)->delete();
		if($del){
			echo "Your Item Deleted";
		} else {
			echo "Not Found or Already Deleted";
		}
	}


}
