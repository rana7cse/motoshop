<?php

class SupplierController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$all = Supplier::all();
		$op = array();
		foreach($all as $data){
			$op[] = array(
				"{$data->id}",
				$data->supp_name,
				$data->contact_f,
				$data->email,
				$data->supp_mgm,
				"{$data->created_at}",
				"action"
			);
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
		$input = Input::all();
		$data = array(
			'supp_name' 	=> $input['newSupName'],
			'supp_type' 	=> $input['newSupType'],
			'supp_add' 		=> $input['newSupAdd'],
			'email' 		=> $input['newSupEmail'],
			'contact_f' 	=> $input['newSupPhone'],
			'contact_s' 	=> $input['newSupPhone2'],
			'supp_mgm'		=> $input['newSupMgm']
		);
		$insert = Supplier::create($data);
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
		return Supplier::find($id);
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
			'supp_name' 	=> $input['editSupName'],
			'supp_type' 	=> $input['editSupType'],
			'supp_add' 		=> $input['editSupAdd'],
			'email' 		=> $input['editSupEmail'],
			'contact_f' 	=> $input['editSupPhone'],
			'contact_s' 	=> $input['editSupPhone2'],
			'supp_mgm'		=> $input['editSupMgm']
		);
		$update = Supplier::where('id','=',$id)->update($data);
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
		$del = Supplier::find($id)->delete();
		if($del){
			echo "Your Item Deleted";
		} else {
			echo "Not Found or Already Deleted";
		}
	}


}
