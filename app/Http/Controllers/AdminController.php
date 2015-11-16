<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Posts;

use Illuminate\Http\Request;

class AdminController extends Controller {


	function __construct()
	{
		$this->middleware('admin');
	}

	public function dashboard()
	{
		$posts = Posts::latest('published_at')->unpublished()->get();
		return view('admin.dashboard', compact('posts'));
	}

	public function destroy($post)
	{
		Posts::whereSlug($post)->delete();
		return redirect('');
	}

}
