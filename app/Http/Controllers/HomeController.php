<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CoursesModel;

class HomeController extends Controller
{
	function __construct()
	{
		$this->courses = new CoursesModel;
	}

    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {   
        $data['menu'] = "Dashboard ".Auth::user()->role;
        $data['courses'] = $this->courses->get_by_user(Auth::id());
        return view('dashboard',$data);
    }

    public function add_course(Request $request)
    {
    	$dataInsert['id_user'] = Auth::id();
    	$dataInsert['name'] = $request->name;
    	$dataInsert['desc'] = $request->desc;
    	$this->courses->save_data($dataInsert);
		return redirect()->back();
    }

    public function delete(Request $request)
    {
    	$this->courses->delete_data($request->id);
		return redirect()->back();
    }

    public function get_course(Request $request)
    {
    	return $this->courses->get_by_id($request->id);
    }

    public function edit(Request $request)
    {
    	$dataUpdate['name'] = $request->name;
    	$dataUpdate['desc'] = $request->desc;
    	$this->courses->update_data($request->id,$dataUpdate);
    	return redirect()->back();
    }
}
