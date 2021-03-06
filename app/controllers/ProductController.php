<?php

class ProductController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$all = Product::all();
		$op = array();
		foreach($all as $data){
			$op[] = array("{$data->id}",$data->product_name,"$data->bike_cc",$data->model,"action");
		}
		return json_encode(array("data"=>$op));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = array(
			'product_name' => Input::get('pro_name'),
			'bike_cc' => Input::get('pro_cc'),
			'model' => Input::get('pro_model')
		);
		$insert = Product::create($data);
		if($insert){
			return json_encode(array('error'=>0,'success'=>1));
		} else {
			return json_encode(array('error'=>1,'success'=>0));
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
		return Product::find($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return Product::find($id);
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
		$product = Product::where('id','=',$input['editProductId']);
		$update = $product->update(
			array(
				'product_name' => $input['editProName'],
				'bike_cc' => $input['editProcc'],
				'model' => $input['editProModel']
			)
		);

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
		$del = Product::destroy($id);
		if($del){
			return "successfully deleted";
		} else {
			return 'not found';
		}
	}
}
