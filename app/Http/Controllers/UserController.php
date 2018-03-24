<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Drug;
use App\Issue;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Hamcrest\Core\Is;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
	public function login(Request $request){
		if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
			return redirect()->route('home');
		}else{
			return $this->backWithMessage("Sorry","Login Failed");
		}
	}
	
    public function addUser(Request $request){
	    $user = new User();
	    $user->name = $request['name'];
	    $user->username = $request['username'];
	    if(User::where('username', $user->username)->count() > 0){
	    	return $this->backWithMessage("Sorry", "That Username already exists");
	    }
	    $user->phone = $request['phone'];
	    $user->duty = $request['duty'];
	    $user->idno = $request['idno'];
	    $password = $this->generateRandomString();
	    $user->password = bcrypt($password);
	    $user->workno = $request['workno'];
	    if($user->save()){
	    	return $this->backWithMessage("Success", "Password is : ". $password);
	    }
	    return $this->backWithUnknownError();
    }
	
	public function generateRandomString($length = 4) {
		$characters = '23456789ABCDEFGHIJKMNPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function backWithMessage($title, $message){
    	return redirect()->back()->with([
    		'messageTitle' => $title,
		    'message' => $message
	    ]);
	}
	
	public function resetUserPassword($username){
    	if(User::where('username', $username)->count() != 1){
    		return $this->backWithMessage("Sorry", "User Not Found");
	    }
	    $user = User::where('username', $username)->first();
    	$password = $this->generateRandomString();
    	$user->password = bcrypt($password);
    	if($user->save()){
    		return $this->backWithMessage("Success", "New Password is: ". $password);
	    }
	    return $this->backWithUnknownError();
	}
	
	public function deleteUser($username){
    	if(User::where('username', $username)->count() != 1){
    		return $this->backWithMessage("Sorry", "User Not Found");
	    }
	    $user = User::where('username', $username)->first();
    	if($user->delete()){
    		return $this->backWithMessage("Success", "User Has Been Deleted");
	    }
	    return $this->backWithUnknownError();
	}
	
	public function backWithUnknownError(){
    	return $this->backWithMessage("Error", "Something Went Wrong While Processing your request, Please Try again later");
	}
	
	public function postNewDrug(Request $request){
    	$drug = new Drug();
    	$drug->genname = $request['genname'];
    	$drug->chemname = $request['chemname'];
    	$drug->brandname = $request['brandname'];
    	$drug->unittype = $request['unittype'];
    	$drug->unitsize = $request['unitsize'];
    	if($drug->save()){
    		return $this->backWithMessage("Success", "Drug Successfully Added, You can begin adding to its inventory now");
	    }
    	return $this->backWithUnknownError();
	}
	
	public function postUpdateDrug(Request $request){
		$drug = Drug::where('id', $request['drugid'])->first();
		$drug->genname = $request['genname'];
		$drug->chemname = $request['chemname'];
		$drug->brandname = $request['brandname'];
		$drug->unittype = $request['unittype'];
		$drug->unitsize = $request['unitsize'];
		if($drug->save()){
			return $this->backWithMessage("Success", "Drug Successfully Updated");
		}
		return $this->backWithUnknownError();
	}
	
	public function postTopUp(Request $request){
		if(Drug::where('id', $request['drugid'])->count() != 1){
			return $this->backWithUnknownError();
		}
		$delivery = new Delivery();
		$delivery->drug = $request['drugid'];
		$delivery->user = Auth::user()->id;
		$delivery->amount = $request['amount'];
		$delivery->supplier = $request['source'];
		if($delivery->save()){
			return $this->backWithMessage("Success", "Drug Has Been Topped Up, Continue issuing it out");
		}
		return $this->backWithUnknownError();
	}
	
	public function postToCart(Request $request){
		if(!$this->sufficientDrugs($request['drugid'], $request['amount'])){
			return $this->backWithMessage("Sorry", "Your Storage is not sufficient enough");
		}
		$drug = Drug::where('id', $request['drugid'])->first();
		$this->addToCart($drug->id, $drug->id, $request['amount'], 0);
		return $this->backWithMessage("Success", "Drug Added to Cart");
	}
	
	public function addToCart($productId, $name, $amount, $price){
		Cart::add($productId, $name, $amount, $price);
	}
	
	public function sufficientDrugs($drugId, $neededAmount){
		if(Delivery::where('drug', $drugId)->sum('amount') - Issue::where('drug', $drugId)->sum('amount') < $neededAmount){
			return false;
		}
		return true;
	}
	
	public function removeFromCart($rowId){
    	Cart::remove($rowId);
    	return $this->backWithMessage("Success", "Item Removed from Cart");
	}
	
	public function postCheckOutCart(Request $request){
		$client = $request['issueto'];
		$glitch = false;
		foreach (Cart::content() as $cart){
			if($this->sufficientDrugs($cart->name, $cart->qty)){
				$issue = new Issue();
				$issue->drug = $cart->name;
				$issue->amount = $cart->qty;
				$issue->issuedto = $client;
				$issue->user = Auth::user()->id;
				$issue->save();
				//clear item from cart
				Cart::remove($cart->rowId);
			}else{
				$glitch=true;
			}
		}
		if($glitch){
			return $this->backWithMessage("Error", "Some Items in your cart are not available");
		}else{
			return $this->backWithMessage("Success", "Cart Cleared and transaction have been recorded");
		}
		return $this->backWithUnknownError();
	}
	
	public function updatePassword(Request $request){
		$pass = $request['pass'];
		$newpass = $request['newpass'];
		$conpass = $request['conpass'];
		if($conpass == $newpass){
			if(bcrypt($pass) == Auth::user()->password){
				$user = Auth::user();
				$user->password = bcrypt($pass);
				if($user->save()){
					return $this->backWithMessage("Success", "Password Updated");
				}
			}else{
//				return Auth::user()->getAuthPassword();
				return bcrypt($pass);
			}
		}else{
			return "Kubadd";
		}
		return $this->backWithUnknownError();
	}
}
