<?php

class ReferanceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$all = Referance::all();
		$op = array();
		foreach($all as $data){
			$op[] = array(
				"{$data->id}",
				$data->ref_name,
				$data->Father_Name,
				$data->thana,
				$data->zilla,
				$data->contact,
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
		$data = Array(
			'ref_name' => $input['refName'],
    		'Father_Name'	=>	$input['refFather'],
    		'address'	=>	$input['refVillage'],
    		'thana'	=>	$input['refThana'],
    		'zilla'	=>	$input['refZilla'],
    		'contact'	=>	$input['refPhone'],
    		'contact2'	=>	$input['refPhone2']
		);
		$insert = Referance::create($data);
		if($insert){
			return json_encode(array('error'=>0,'success'=>1, 'id' => $insert));
		} else {
			return json_encode(array('error'=>1,'success'=>0));
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
		return Referance::find($id);
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
