<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model {
	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'courses';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'professor_id'];

	protected $dates = ['deleted_at'];

	public function professor()
	{
		return $this->belongsTo('App\Professor');
	}

	public function school()
	{
		return $this->professor()->school();
	}

	public function cribs()
	{
		return $this->hasMany('App\Crib');
	}
}
