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
				$data->first_name,
				$data->fat_name,
				$data->thana,
				$data->zilla,
				$data->phone,
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
		try{
			$data = array(
					'first_name'	=>$input['cusFirstName'],
					'fat_name'		=>$input['cusFatName'],
					'address'		=>$input['cusAddress'],
					'thana'			=>$input['cusAddThana'],
					'zilla'			=>$input['cusAddZilla'],
					'division'		=>$input['cusAddDivision'],
					'phone'			=>$input['cusPhone'],
					'phone2'		=>$input['cusPhone2'],
					'email'			=>$input['cusEmail']
			);
			$insert = Customar::create($data);
			if($insert){
				return json_encode(array('error'=>0,'success'=>1, 'id' => $insert->id));
			} else {
				return json_encode(array('error'=>1,'success'=>0));
			}
		}catch (Exception $e){
			echo $e->getMessage();
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
				'first_name'	=>$input['edit_cusFirstName'],
				'fat_name'		=>$input['edit_cusFatName'],
				'address'		=>$input['edit_cusAddress'],
				'thana'			=>$input['edit_cusAddThana'],
				'zilla'			=>$input['edit_cusAddZilla'],
				'division'		=>$input['edit_cusAddDivision'],
				'phone'			=>$input['edit_cusPhone'],
				'phone2'		=>$input['edit_cusPhone2'],
				'email'			=>$input['edit_cusEmail']
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

	public function searchIndex(){
		$cus_info = DB::table('customars')->select('id','first_name','phone')->get();
		$thana_info = DB::table('customars')->select('thana')->distinct()->get();
		$ref_info = DB::table('referance')->select('id','ref_name','contact')->get();

		$data =[
			"cus" => $cus_info,
			"thana"	=> $thana_info,
			"ref"	=> $ref_info
		];

		return View::make("customars.search",compact("data"));
	}


	public function doSearch(){
		$input = Input::all();
		$text = $input['text'];
		$op = [];
		switch($input['by']){
			case 1 :
				$op = DB::table('customars')
						->where('first_name','like',"%$text%")
						->select('id','first_name','fat_name','address','thana','zilla','phone')
						->get();
				break;
			case 2 :
				$op = DB::table('customars')
						->where('phone','like',"%$text%")
						->orWhere('phone2','like',"%$text%")
						->select('id','first_name','fat_name','address','thana','zilla','phone')
						->get();
				break;
			case 3 :
				$op = DB::table('customars')
						->where('thana','like',"%$text%")
						->select('id','first_name','fat_name','address','thana','zilla','phone')
						->get();
				break;
			case 4 :
				$op = DB::table('customars')
						->join('moto_sold','moto_sold.cus_id','=','customars.id')
						->join('referance','moto_sold.ref_id','=','referance.id')
						->where('referance.ref_name','like',"%$text%")
						->select('customars.id','customars.first_name','customars.fat_name','customars.address','customars.thana','customars.zilla','customars.phone')
						->get();
				break;
			case 5 :
				$op = DB::table('customars')
						->join('moto_sold','moto_sold.cus_id','=','customars.id')
						->join('referance','moto_sold.ref_id','=','referance.id')
						->where('referance.contact','like',"%$text%")
						->orWhere('referance.contact2','like',"%$text%")
						->select('customars.id','customars.first_name','customars.fat_name','customars.address','customars.thana','customars.zilla','customars.phone')
						->get();
				break;
			default :
				$op = [];
		}

		return ["data" => $op];
	}

	// All Customar Information Here

	public function getState($id){
		echo $id;
	}


}
