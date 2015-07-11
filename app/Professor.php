<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model {
	use SoftDeletes;

	/**
	 * The database table used by the model.
	 * @var string
	 */
	protected $table = 'professors';

	/**
	 * The attributes that are mass assignable.
	 * @var array
	 */
	protected $fillable = ['name', 'added_by_user_id', 'school_id'];

	/**
	 * Date fields used on the table.
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	public function cribs()
	{
		return $this->hasMany('App\Crib');
	}

	public function school()
	{
		return $this->belongsTo('App\School');
	}
}
