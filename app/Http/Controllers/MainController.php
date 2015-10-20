<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request;
use App\Posts;

class MainController extends Controller {

	public function index()
	{
		$posts = Posts::latest('published_at')->published()->get();
		return view('forum.index', compact('posts'));
	}

	public function todo()
	{
		return view('forum.todo');
	}

}
