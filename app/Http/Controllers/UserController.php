<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use Request;
use Image;
use Input;
use File;

class UserController extends Controller {

	function __construct() {
		$this->middleware('auth');
	}

	public function dashboard()
	{
		return view('user.dashboard');
	}

	public function edit()
	{
		return view('user.edit');
	}

	public function picture()
	{
		if(Input::file())
		{
			$user = Auth::user();

		    $image = Input::file('image');
		    $filename  = Auth::user()->name . '.' . $image->getClientOriginalExtension();

		    $path = public_path('profilepics/' . $filename);

			if (File::exists($filename)) {
				File::delete($filename);
			}

			Image::make($image->getRealPath())->resize(250, 250)->save($path);

			$user->profilepic = $filename;
			$user->save();

			return view('user.edit');
		}

		return ('Didnt work');

	}

	public function signature()
	{
		$user = Auth::user();

		$signature = Input::get('signature');

		$user->signature = $signature;
		$user->save();

		return view('user.edit');
	}

}
