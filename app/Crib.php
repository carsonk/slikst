<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crib extends Model {
	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cribs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'filename', 'up_votes',
		'down_votes', 'user_id', 'school_id', 'professor_id'];

	/**
	 * Dates used in the table.
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function course()
	{
		return $this->belongsTo('App\Course');
	}

	public function professor()
	{
		return $this->course()->professor();
	}

	public function school()
	{
		return $this->professor()->school();
	}
}
