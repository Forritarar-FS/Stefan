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
		$posts = Posts::latest('published_at')->published()->get();
		return view('forum.todo', compact('posts'));
	}

	public function general()
	{
		$posts = Posts::latest('published_at')->published()->general()->get();
		return view('forum.general', compact('posts'));
	}

	public function faq()
	{
		$posts = Posts::latest('published_at')->published()->faq()->get();
		return view('forum.faq', compact('posts'));
	}

	public function help()
	{
		$posts = Posts::latest('published_at')->published()->help()->get();
		return view('forum.help', compact('posts'));
	}

	public function play()
	{
		$posts = Posts::latest('published_at')->published()->play()->get();
		return view('forum.play', compact('posts'));
	}

}
