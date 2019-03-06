<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use Auth;
class UsersController extends Controller
{
	function __construct()
	{
		$this->users = new UsersModel;
	}
    //
    public function registrasi_post(Request $request)
    {
    	$dataInsert['name']=$request->name;
    	$dataInsert['email']=$request->email;
    	$dataInsert['role']=$request->role;
    	$dataInsert['password']=bcrypt($request->password);
    	if ($this->users->save_data($dataInsert)) {
    		return redirect()->route('dashboard');
    	}else{
    		return redirect()->back();
    	}
    }

    public function login_post(Request $request)
    {
    	Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    	if(Auth::check()){
    		return redirect()->route('dashboard');
    	}else{
    		return redirect()->back();
    	}
    }
}
