<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showLogin()
	{
		return View::make('login');
	}

	public function doLogin(){
		$auth = User::where('user_name', Input::get('login'))
			->where('password', Input::get('password'))
			->first();
		if(isset($auth->exists)){
			Auth::login($auth);
			User::setUser('user_id',Input::get('user_name'));
			return Redirect::to('/');
		} else {
			return Redirect::to('/');
		}
	}

	public function logout()
	{
		if (Session::has('user_id'))
		{
			Session::flush();
		}
			Auth::logout();
			return Redirect::to('/');
	}

}
