<?php

class InventoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$all = DB::table('inventory')
			->join('product','product.id','=','inventory.product_id')
			->select('inventory.id','inventory.created_at','inventory.eng_no','inventory.chs_no','inventory.is_sell','inventory.color','inventory.sell_rate','product.product_name')
			->get();
		$op = array();
		foreach($all as $list){
			$date = substr($list->created_at,0,10);
			$status = ($list->is_sell != 0)? "SOLD" : "STOCK";
			$op[] = array(
				$list->id,
				$list->eng_no,
				$list->chs_no,
				$list->product_name,
				$list->color,
				$list->sell_rate,
				$date,
				$status,
				"Action"
			);
		}
		return json_encode(array('data'=>$op));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$item = Input::all();
		$data = array(
			'product_id' => $item['pro_name'],
			'eng_no' => $item['eng_no'],
			'chs_no' => $item['chs_no'],
			'is_sell' => '0',
			'color' => $item['pro_color'],
			'quantity' => 1,
			'buy_rate' => $item['pro_buy_rate'],
			'sell_rate' => $item['pro_sell_rate'],
			'img' => 'NA',
			'item_no' => 'NA',
			'supplyir_id' => 'NA'
		);

		try{
			$insert = Inventory::create($data);
			if($insert){
				return json_encode(array('error'=>0,'success'=>1));
			} else {
				return json_encode(array('error'=>1,'success'=>0));
			}
		}catch (Exception $e){
			print_r($e);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Inventory::find($id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$input = Input::all();
		$id = $input['rowId'];
		$data = array(
			'product_id' => $input['edit_pro_name'],
			'eng_no' => $input['editEngineNo'],
			'chs_no' => $input['edit_chs_no'],
			'color' => $input['edit_pro_color'],
			'buy_rate' => $input['edit_pro_buy_rate'],
			'sell_rate' => $input ['edit_pro_sell_rate'],
		);
		$update = Inventory::where('id','=',$id)->update($data);
		if($update){
			return json_encode(array('error'=>0,'success'=>1));
		} else {
			return json_encode(array('error'=>1,'success'=>0));
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$del = Inventory::find($id)->delete();
		if($del){
			echo "Your Item Deleted";
		} else {
			echo "Not Found or Already Deleted";
		}
	}


}
