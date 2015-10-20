<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request;
use App\Http\Requests\PostRequest;
use App\Posts;
use Auth;

class PostController extends Controller {

	function __construct() {
		$this->middleware('auth', ['only' => 'create']);
	}

	public function show($id)
	{
		$post = Posts::findOrFail($id);

		return view('forum.view', compact('post'));
	}

	public function store(PostRequest $request)
	{
		$post = new Posts($request->all());

		Auth::user()->posts()->save($post);

		return redirect('');
	}

	public function update($id, PostRequest $request)
	{
		$post = Posts::findOrFail($id);

		$post->update($request->all());

		return redirect('');
	}

	public function edit($id)
	{
		$post = Posts::findOrFail($id);
		return view('forum.edit', compact('post'));
	}


		public function create()
		{
			return view('forum.create');
		}


}
