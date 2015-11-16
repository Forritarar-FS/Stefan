<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comments;
use App\Posts;
use App\CommentVotes;
use Request;
use Carbon\Carbon;
use Auth;

class CommentController extends Controller {

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

	public function upvote($post, $comment)
	{
		$posts = Posts::whereSlug($post)->first();
		$comments = Comments::whereId($comment)->first();

		$existing_vote = CommentVotes::whereCommentsId($comments->id)->whereUserId(Auth::id())->first();

		if(!is_null($existing_vote)) {
			$existing_vote->vote = "up";
			$existing_vote->save();
			return redirect('post/' . $posts->slug);
		} else {
			$vote = new CommentVotes();
			$vote->user()->associate(Auth::user());
			$vote->posts()->associate($posts);
			$vote->comments()->associate($comments);
			$vote->vote = "up";
			$vote->save();

			return redirect('post/' . $posts->slug);
		}
	}

	public function downvote($post)
	{
		$posts = Posts::whereSlug($post)->first();
		$comments = Comments::whereId($comment)->first();

		$existing_vote = CommentVotes::whereCommentsId($comments->id)->whereUserId(Auth::id())->first();

		if(!is_null($existing_vote)) {
			$existing_vote->vote = "down";
			$existing_vote->save();
			return redirect('post/' . $posts->slug);
		} else {
			$vote = new PostVotes();
			$vote->user()->associate(Auth::user());
			$vote->posts()->associate($posts);
			$vote->comments()->associate($comments);
			$vote->vote = "down";
			$vote->save();

			return redirect('post/' . $posts->slug);
		}
	}

}
