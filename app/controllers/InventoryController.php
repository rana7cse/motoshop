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
			'comision_tk'  =>	$item['pro_comi_rate'],
			'img' => 'NA',
			'item_no' => 'NA',
			'supplyir_id' => $item['supplyir_id']
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

	/**
	 * Search Product functions
	 */

	public function findName($id){
		$data = DB::table('inventory')->join('product','inventory.product_id','=','product.id')
				->select('inventory.id','product.product_name','inventory.eng_no','inventory.chs_no','inventory.sell_rate')
				->where('inventory.product_id','=',$id)
				->where('inventory.is_sell','=',0)
				->get();
		$op = [];
		foreach($data as $mata){
			$op[] = [$mata->id,$mata->eng_no,$mata->chs_no,$mata->product_name,$mata->sell_rate,"action"];
		}
		return array('data'=>$op);
	}

	public  function findProduct($id){
		$data = DB::table('inventory')->join('product','inventory.product_id','=','product.id')
			->select('inventory.id','product.product_name','inventory.product_id','inventory.eng_no','inventory.chs_no','inventory.sell_rate','product.bike_cc','product.model')
			->where('inventory.id','=',$id)
			->get();
		return $data;
	}

	public function reportAll(){
		$report = DB::select(
			DB::raw("SELECT (SELECT product_name FROM product WHERE id=product_id) as product,product_id,count(product_id) as total FROM inventory WHERE is_sell = '0' GROUP BY product_id")
		);
		return View::make('product.report',compact('report'));
	}

	public function availableinv($id){
		$data = DB::table('inventory')
			->join('product','product.id','=','inventory.product_id')
			->select('inventory.buy_rate','inventory.eng_no','inventory.chs_no','product.product_name','product.model','inventory.color','inventory.created_at')
			->where('inventory.is_sell','=','0')
			->where('inventory.product_id','=',$id)
			->get();
		return $data;
	}
}
