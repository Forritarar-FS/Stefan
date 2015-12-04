<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comments;
use App\Posts;
use App\CommentVotes;
use Request;
use Carbon\Carbon;
use Auth;
use Redirect;

class CommentController extends Controller {

	function __construct() {
		$this->middleware('auth', ['only' => ['upvote', 'downvote']]);
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

	public function upvote($post, $comment)
	{
		$posts = Posts::whereSlug($post)->first();
		$comments = Comments::whereId($comment)->first();

		$existing_vote = CommentVotes::whereCommentsId($comments->id)->whereUserId(Auth::id())->first();

		if(!is_null($existing_vote)) {
			$existing_vote->vote = "up";
			$existing_vote->save();

			$commUpvote = $post->commentvotes()->whereVote("up")->count();
			$commDownvote = $post->commentvotes()->whereVote("down")->count();

			$commVote = $commUpvote - $commDownvote;

			$comments->votes = $commVote;
			$comments->save();

			return redirect('post/' . $posts->slug);
		} else {
			$vote = new CommentVotes();
			$vote->user()->associate(Auth::user());
			$vote->posts()->associate($posts);
			$vote->comments()->associate($comments);
			$vote->vote = "up";
			$vote->save();

			$comments->votes += 1;
			$comments->save();

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

			$commUpvote = $post->commentvotes()->whereVote("up")->count();
			$commDownvote = $post->commentvotes()->whereVote("down")->count();

			$commVote = $commUpvote - $commDownvote;

			$comments->votes = $commVote;
			$comments->save();

			return redirect('post/' . $posts->slug);
		} else {
			$vote = new PostVotes();
			$vote->user()->associate(Auth::user());
			$vote->posts()->associate($posts);
			$vote->comments()->associate($comments);
			$vote->vote = "down";
			$vote->save();

			$comments->votes -= 1;
			$comments->save();

			return redirect('post/' . $posts->slug);
		}
	}

	public function destroy($post, $comment)
	{
		Comments::whereId($comment)->delete();
		return Redirect::Back();
	}

	public function update($post, $comment)
	{
		$comment = Comments::whereId($comment)->firstOrFail();

		$input = Request::all();

		$comment->update($input);

		return Redirect::Back();
	}

}
