<?php
//----------------------------------------------|
//----------- Application Routes ---------------|
//----------------------------------------------|

// --- Home Page -------
Route::get('/', function()
{
	//return View::make('store');
	return View::make('sell.index');
});

// ------ Product Routes Here --------
Route::get('/product/manage',function(){
	return View::make('product.index');
});
Route::get('/product','ProductController@index');
Route::post('/product/create','ProductController@create');
Route::get('/product/edit/{id}','ProductController@edit');
Route::get('/product/{id}','ProductController@show');
Route::post('/product/update','ProductController@update');
Route::get('/product/delete/{id}','ProductController@destroy');
// --------- Customer Route ----------
Route::get('/customars',function(){
	return View::make('customars.index');
});
Route::get('/customar_all',"CustomarController@index");
Route::post('/customar_add',"CustomarController@create");
Route::get('/customer/{id}',"CustomarController@show");
Route::post('/customar/update',"CustomarController@update");
Route::get('/customer/del/{id}',"CustomarController@destroy");

// --------- Supplier Route ----------
Route::get('suppliers',function(){
	return View::make('supplier.index');
});
Route::get('/supplier/all',"SupplierController@index");
Route::post('/supplier/add',"SupplierController@create");
Route::get('/supplier/{id}',"SupplierController@show");
Route::post('/supplier/update',"SupplierController@update");
Route::get('/supplier/del/{id}',"SupplierController@destroy");

// --------- Inventory Route ----------
Route::get('/inventory',function(){
	return View::make('inventory.index');
});
Route::get('/inventory/all','InventoryController@index');
Route::post('/inventory/create','InventoryController@create');
Route::get('/inventory/{id}','InventoryController@show');
Route::post('/inventory/update','InventoryController@update');
Route::get('/inventory/delete/{id}','InventoryController@destroy');
//---- search exp ------
Route::get('/inventory/prosearch/{id}','InventoryController@findName');
Route::get('/inventory/prosel/{id}','InventoryController@findProduct');
Route::get('/inventory/report/all','InventoryController@reportAll');
// --------- ORDER Transection Route ----------
Route::get('/order',function(){
	$status = array(
		'totalBilled' => DB::table('pro_buy_info')->sum('ammount'),
		'totalPay'  => DB::table('pro_buy_info')->sum('pay'),
		'totalDue' => DB::table('pro_buy_info')->sum('due')
	);
	return View::make('transection.order',compact("status"));
});
Route::get('/order/all','OrderController@index');
Route::post('/order/make','OrderController@create');
Route::get('/order/{id}','OrderController@show');
Route::post('/order/pay','OrderController@orderPay');
Route::get('/order/del/{id}','OrderController@destroy');

//----------- ORDER PAYMENT ROUTE -----------
Route::get('/payment',function(){
	return View::make('transection.supPay');
});
Route::get('/payment/all','OrderController@allPayment');

//------- Sell Product-------------

Route::get('/sell',function(){
	return View::make('sell.index');
});
Route::get('/sell/report',function(){
	return View::make('sell.report');
});
Route::post('/sell/make','SellController@create');
Route::get('/sell/{to}/{form}','SellController@index');
// Route::get();
// Route::get();


















// --------- Others Route ----------

/*Route::post('/product/image_upload',function(){
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
});*/
