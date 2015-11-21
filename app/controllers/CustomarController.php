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


}
