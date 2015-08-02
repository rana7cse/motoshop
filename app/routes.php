<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('store');
});

/* ***
 * Eshop Product Routes Starts
 *
 */

Route::get('/product/manage',function(){
	return View::make('product.index');
});

Route::get('/product','ProductController@index');
Route::post('/product/create','ProductController@create');
Route::get('/product/edit/{id}','ProductController@edit');
Route::get('/product/{id}','ProductController@show');
Route::post('/product/update','ProductController@update');
Route::get('/product/delete/{id}','ProductController@destroy');

/*
 * Eshop Product Routes Ends
 *
 * */

/* ***
 * Eshop Inventory Routes Starts
 *
 */

Route::get('/inventory',function(){
	return View::make('inventory.index');
});

Route::get('/inventory/all','InventoryController@index');
Route::post('/inventory/create','InventoryController@create');
Route::get('/inventory/{id}','InventoryController@show');
Route::post('/inventory/update','InventoryController@update');
Route::get('/inventory/delete/{id}','InventoryController@destroy');

/*
 * Eshop Inventory Routes Ends
 *
 * */

//Utility Route;

Route::post('/product/image_upload',function(){
	if(Input::hasFile('my_image')){
		$filename = Input::file('my_image')->getClientOriginalName();
		$extension = Input::file('my_image')->getClientOriginalExtension();
		try {

			$file = Input::file('my_image')->move('image/product', $filename);
			echo json_encode(array('name'=>$filename,'ext'=>$extension));

		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
});
