<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'schools';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	/**
	 * Turns off timestamps.
	 * @var bool
	 */
	public $timestamps = false;

	public function courses()
	{
		return $this->hasManyThrough('App\Course', 'App\Professor');
	}

	public function cribs()
	{
		return $this->hasManyThrough('App\Crib', 'App\Professor');
	}
}
