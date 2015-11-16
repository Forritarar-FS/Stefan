<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request;
use App\Http\Requests\PostRequest;
use App\Posts;
use App\Comments;
use Carbon\Carbon;
use Auth;
use App\PostVotes;
use App\CommentVotes;

class PostController extends Controller {

	function __construct() {
		$this->middleware('auth', ['only' => 'create']);
	}

	public function show($slug)
	{
		$post = Posts::whereSlug($slug)->first();

		$post->views += 1;
		$post->save();

		$postUpvote = $post->postvotes()->whereVote("up")->count();
		$postDownvote = $post->postvotes()->whereVote("down")->count();

		$postVote = $postUpvote - $postDownvote;

		$commUpvote = $post->commentvotes()->whereVote("up")->count();
		$commDownvote = $post->commentvotes()->whereVote("down")->count();

		$commVote = $commUpvote - $commDownvote;


		$comments = $post->comments()->orderBy('published_at', 'asc')->get();

		return view('forum.view', compact('post', 'comments', 'postVote', 'commVote'));
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

	public function upvote($post)
	{
		$posts = Posts::whereSlug($post)->first();

		$existing_vote = PostVotes::wherePostsId($posts->id)->whereUserId(Auth::id())->first();

		if(!is_null($existing_vote)) {
			$existing_vote->vote = "up";
			$existing_vote->save();
			return redirect('post/' . $posts->slug);
		} else {
			$vote = new PostVotes();
			$vote->user()->associate(Auth::user());
			$vote->posts()->associate($posts);
			$vote->vote = "up";
			$vote->save();

			return redirect('post/' . $posts->slug);
		}
	}

	public function downvote($post)
	{
		$posts = Posts::whereSlug($post)->first();

		$existing_vote = PostVotes::wherePostsId($posts->id)->whereUserId(Auth::id())->first();

		if(!is_null($existing_vote)) {
			$existing_vote->vote = "down";
			$existing_vote->save();
			return redirect('post/' . $posts->slug);
		} else {
			$vote = new PostVotes();
			$vote->user()->associate(Auth::user());
			$vote->posts()->associate($posts);
			$vote->vote = "down";
			$vote->save();

			return redirect('post/' . $posts->slug);
		}
	}


}
