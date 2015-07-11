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
	protected $fillable = ['name', 'school_id'];

	protected $dates = ['deleted_at'];

	public function school()
	{
		return $this->belongsTo('App\School');
	}

	public function creator()
	{
		return $this->belongsTo('App\User', 'added_by_user_id');
	}

	public function cribs()
	{
		return $this->hasMany('App\Crib');
	}
}
