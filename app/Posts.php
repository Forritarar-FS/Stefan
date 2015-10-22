<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Posts extends Model implements SluggableInterface {

	use SluggableTrait;

	protected $sluggable = [
		'build_from' => 'title',
		'save_to' => 'slug',
	];

	protected $fillable = [
		'title',
		'body',
		'published_at',
		'board'
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

	public function scopeGeneral($query)
	{
		$query->where('board', '=', 'general');
	}

	public function scopeFaq($query)
	{
		$query->where('board', '=', 'faq');
	}

	public function scopeHelp($query)
	{
		$query->where('board', '=', 'help');
	}

	public function scopePlay($query)
	{
		$query->where('board', '=', 'play');
	}

	public function setPublishedAtAttribute($date)
	{
		$this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function comments()
	{
		return $this->hasMany('App\Comments');
	}

}
