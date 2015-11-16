<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentVotes extends Model {

	public function posts()
	{
		return $this->belongsTo('App\Posts');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function comments()
	{
		return $this->belongsTo('App\Comments');
	}

}
