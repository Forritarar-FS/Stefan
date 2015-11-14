<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PostVotes extends Model {

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function posts()
	{
		return $this->belongsTo('App\Posts');
	}

}
