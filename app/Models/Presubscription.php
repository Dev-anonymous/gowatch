<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Presubscription
 * 
 * @property int $id
 * @property int $users_id
 * @property Carbon|null $from
 * @property Carbon|null $to
 * @property int|null $active
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Presubscription extends Model
{
	protected $table = 'presubscription';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'active' => 'int'
	];

	protected $dates = [
		'from',
		'to'
	];

	protected $fillable = [
		'users_id',
		'from',
		'to',
		'active'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
