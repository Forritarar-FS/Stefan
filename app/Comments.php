<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

	protected $fillable = [
		'body',
		'published_at'
	];

	protected $dates = ['published_at'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function posts()
	{
		return $this->belongsTo('App\Posts');
	}

}
