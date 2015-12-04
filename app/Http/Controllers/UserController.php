<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

use Request;
use Image;
use Input;
use File;
use Redirect;

class UserController extends Controller {

	function __construct() {
		$this->middleware('auth', ['except' => ['profile', 'userPosts', 'userComments']]);
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

			return view('user.profile.index', compact('user'));
		}

		return ('Didnt work');

	}

	public function signature()
	{
		$user = Auth::user();

		$signature = Input::get('signature');

		$user->signature = $signature;
		$user->save();

		return view('user.profile.index', compact('user'));
	}

	public function profile($user)
	{
		$user = User::whereName($user)->firstOrFail();

		return view('user.profile.index', compact('user'));
	}

	public function userPosts($user)
	{
		$user = User::whereName($user)->firstOrFail();
		$posts = $user->posts;

		return view('user.profile.posts', compact('user', 'posts'));
	}

	public function userComments($user)
	{
		$user = User::whereName($user)->firstOrFail();
		$comments = $user->comments;

		return view('user.profile.comments', compact('user', 'comments'));
	}

	public function userEdit($user)
	{
		$user = User::whereName($user)->firstOrFail();

		if($user->name == Auth::user()->name) {
			return view('user.profile.edit', compact('user'));
		}

		return Redirect::to('user/' . $user->name)->with('message','You cannot edit someone elses profile.');


	}
}
