<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request;
use App\Http\Requests\PostRequest;
use App\Posts;
use App\Comments;
use Carbon\Carbon;
use Auth;

class PostController extends Controller {

	function __construct() {
		$this->middleware('auth', ['only' => 'create']);
	}

	public function show($slug)
	{
		$post = Posts::whereSlug($slug)->first();

		$comments = $post->comments()->orderBy('published_at', 'asc')->get();

		return view('forum.view', compact('post', 'comments'));
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

	public function comment($post)
	{
		$posts = Posts::whereSlug($post)->first();

		$comment = new Comments(Request::all());
		$comment->published_at = Carbon::now();
		$comment->user()->associate(Auth::user());
		$comment->posts()->associate($posts);
		$comment->save();

		return redirect('post/'. $post);
	}

	public function destroy($id)
	{
		Posts::whereId($id)->delete();
		return redirect('');
	}


}
