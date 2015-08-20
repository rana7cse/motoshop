<?php

class CustomarController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$all = Customar::all();
		$op = array();
		foreach($all as $data){
			$op[] = array(
				"{$data->id}",
				$data->first_name." ".$data->last_name,
				$data->phone,
				$data->email,
				$data->address,
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
			'first_name' 	=> $input['cusFirstName'],
    		'last_name' 	=> $input['cusLastName'],
    		'address' 		=> $input['cusAddress'],
    		'email' 		=> $input['cusEmail'],
    		'phone' 		=> $input['cusPhone'],
    		'phone2' 		=> $input['cusPhone2'],
    		'nid_no'		=> $input['cusNid']
		);
		$insert = Customar::create($data);
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
		return Customar::find($id);
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
			'first_name' 	=> $input['ceditFirstName'],
			'last_name' 	=> $input['ceditLastName'],
			'address' 		=> $input['ceditAddress'],
			'email' 		=> $input['ceditEmail'],
			'phone' 		=> $input['ceditPhone'],
			'phone2' 		=> $input['ceditPhone2'],
			'nid_no'		=> $input['ceditNid']
		);
		$update = Customar::where('id','=',$id)->update($data);
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
		$del = Customar::find($id)->delete();
		if($del){
			echo "Your Item Deleted";
		} else {
			echo "Not Found or Already Deleted";
		}
	}


}
