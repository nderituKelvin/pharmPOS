<?php

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

use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Route;

	Route::get('/',[
		'as' => '/',
		function () {
			return view('system.login');
	}]);
	
	Route::post('login',[
		'as' => 'login',
		'uses' => 'UserController@login'
	]);
	
	Route::get('login', [
		'as' => 'login',
		function(){
			return redirect()->route('logout');
		}
	]);
	
	Route::get('logout',[
		'as' => 'logout',
		function(){
			Auth::logout();
			return redirect()->route('/');
		}
	]);

	Route::get('adduser', [
		'as' => 'addUser',
		function(){
			return view('system.addUser');
		}
	])->middleware('admin');
	
	Route::post('addUser', [
		'as' => 'postAddUser',
		'uses' => 'UserController@addUser'
	])->middleware('admin');
	
	Route::get('viewusers', [
		'as' => 'viewUsers',
		function(){
			$users = User::orderBy('id', 'desc')->get();
			return view('system.users', [
				'users' => $users
			]);
		}
	])->middleware('admin');
	
	Route::get('resetuserpassword/{username}', [
		'as' => 'resetUserPassword',
		'uses' => 'UserController@resetUserPassword'
	])->middleware('admin');
	
	Route::get('deleteuser/{username}', [
		'as' => 'deleteUser',
		'uses' => 'UserController@deleteUser'
	])->middleware('admin');
	
	Route::get('inventory', [
		'as' => 'viewInventory',
		function(){
			$drugs = \App\Drug::get();
			return view('system.inventory', [
				'drugs' => $drugs
			]);
		}
	])->middleware('auth');
	
	Route::post('postNewDrug', [
		'as' => 'postNewDrug',
		'uses' => 'UserController@postNewDrug'
	])->middleware('auth');;
	
	Route::get('updatedrug/{drugid}', [
		'as' => 'getUpdateDrug',
		function($drugid){
			if(\App\Drug::where('id', $drugid)->count() != 1){
				return redirect()->route('/');
			}
			$drug = \App\Drug::where('id', $drugid)->first();
			return view('system.updateDrug', [
				'drug' => $drug
			]);
		}
	])->middleware('auth');;
	
	Route::post('postupdatedrug', [
		'as' => 'postUpdateDrug',
		'uses' => 'UserController@postUpdateDrug'
	])->middleware('auth');;
	
	Route::get('topup/{drugid}', [
		'as' => 'getTopUp',
		function($drugid){
			if(\App\Drug::where('id', $drugid)->count() != 1){
				$userCont = new \App\Http\Controllers\UserController();
				$userCont->backWithUnknownError();
			}
			$drug = \App\Drug::where('id', $drugid)->first();
			return view('system.topUpDrug', [
				'drug' => $drug
			]);
		}
	])->middleware('auth');;
	
	Route::post('postTopUp', [
		'as' => 'postTopUp',
		'uses' => 'UserController@postTopUp'
	])->middleware('auth');;
	
	Route::get('drugs', [
		'as' => 'viewDrugs',
		function(){
			$drugs = \App\Drug::get();
			return view('system.drugs', [
				'drugs' => $drugs
			]);
		}
	])->middleware('auth');;
	
	Route::post('addToCart', [
		'as' => 'postToCart',
		'uses' => 'UserController@postToCart'
	])->middleware('auth');;
	
//	Route::get('cartcont', [
//		'as' => 'cartContent',
//		function(){
//			return Cart::content();
//		}
//	]);
	
	Route::get('cart', [
		'as' => 'viewCart',
		function(){
			return view('system.cart');
		}
	])->middleware('auth');;
	
	Route::get('removefromcart/{rowId}', [
		'as' => 'removeFromCart',
		'uses' => 'UserController@removeFromCart'
	])->middleware('auth');;
	
	Route::post('postCheckOutCart', [
		'as' => 'postCheckOutCart',
		'uses' => 'UserController@postCheckOutCart'
	])->middleware('auth');;
	
	Route::get('reports', [
		'as' => 'showReports',
		function(){
			return view('system.selectRange');
		}
	])->middleware('admin');
	
	Route::post('viewReports', [
		'as' => 'postViewReports',
		function(\Illuminate\Http\Request $request){
			$fromDate = DateTime::createFromFormat('m/d/Y', $request['start']);
			$toDate = DateTime::createFromFormat('m/d/Y', $request['end']);
			
			return view('system.reports', [
				'fromDate' => $fromDate,
				'toDate' => $toDate,
			]);
		}
	])->middleware('admin');
	
	Route::get('home', [
		'as' => 'home',
		function(){
			return view('system.home');
		}
	])->middleware('auth');
	
	Route::get('changepassword', [
		'as' => 'getChangePassword',
		function(){
			return view('system.changePassword');
		}
	]);
	
	Route::post('changePassword', [
		'as' => 'updatePassword',
		'uses' => 'UserController@updatePassword'
	]);
	
//	Route::get('carbon', [
//		'as' => 'carbon',
//		function(){
//			$today = Carbon\Carbon::today();
//			return $today->day;
//		}
//	]);