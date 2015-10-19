<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Posts extends Model {

	protected $fillable = [
		'title',
		'body'
	];

	protected $dates = ['published_at'];

	public function scopePublished($query)
	{
		$query->where('published_at', '<=', Carbon::now());
	}

	public function scopeUnpublished($query)
	{
		$query->where('published_at', '>', Carbon::now());
	}

	public function setPublishedAtAttribute($date)
	{
		$this->attributes['published_at'] = Carbon::parse($date);
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
