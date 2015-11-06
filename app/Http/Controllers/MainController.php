<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request;
use App\Posts;

class MainController extends Controller {

	public function index()
	{
		return view('forum.index');
	}

	public function todo()
	{
		return view('forum.todo');
	}

	public function general()
	{
		$posts = Posts::latest('published_at')->published()->board('general')->get();
		return view('forum.general', compact('posts'));
	}

	public function faq()
	{
		$posts = Posts::latest('published_at')->published()->board('faq')->get();
		return view('forum.faq', compact('posts'));
	}

	public function help()
	{
		$posts = Posts::latest('published_at')->published()->board('help')->get();
		return view('forum.help', compact('posts'));
	}

	public function play()
	{
		$posts = Posts::latest('published_at')->published()->board('play')->get();
		return view('forum.play', compact('posts'));
	}

}
