<?php

//use App\Http\Controllers\HomeController;

// use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix("auth")->group(function(){
    Auth::routes(["verify" => true]);
});

Route::name("logout")->match(["GET", "POST"], "/logout", "Auth\LoginController@logout");

Route::middleware(["auth","inactive"])->group(function(){
    Route::get('/', "HomeController@index");
    //Route::

    //el namespace hace referencia a la carpeta User
    Route::name("users")->namespace("User")->group(function(){
        // Route::resource('users','UserController');
        Route::get('/user', "UserController@index");
        Route::post('/save',"UserController@store");
        Route::name("update")->match(["GET","POST"],"users/{user}","UserController@edit");
        Route::name("edit")->match(["GET","POST"],"edit/{user}","UserController@update");
        Route::name("state")->match(["GET","POST"],"state/{user}/{state}","UserController@state");
        Route::name("changepass")->match(["GET","POST"],"changepass/{user}","UserController@changepass");
    });

    Route::name("customers.")->group(function()
    {
        Route::name("index")->match(["GET","POST"],"customers","CustomerController@index");
        Route::name("saveCustomer")->match(["GET","POST"],"saveCustomer","CustomerController@store");
        Route::name("EditCustomer")->match(["GET","POST"],"EditCustomer/{customer}","CustomerController@update");
        Route::name("DeleteCustomer")->delete("DeleteCustomer/{customer}","CustomerController@destroy");
        Route::name("CustomerList")->match(["GET","POST"],"CustomerList","CustomerController@CustomerList");
        Route::name("saveCustomerSimple")->match(["GET","POST"],"saveCustomerSimple","CustomerController@saveCustomerSimple");
    });

    Route::name("orders.")->group(function()
    {
        Route::name("index")->match(["GET","POST"],"orders","OrderController@index");
        Route::name("saveOrder")->match(["GET","POST"],"saveOrder","OrderController@store");
        Route::name("EditOrder")->match(["GET","POST"],"EditOrder/{order}","OrderController@update");
        Route::name("saveJob")->match(["GET","POST"],"saveJob/{order}","OrderController@saveJob");
        Route::name("ordersReady")->match(["GET","POST"],"ordersReady","OrderController@ready");
        Route::name("pdf")->match(["GET","POST"],"pdf/{order}","PDFController@createPDF");
    });
});


