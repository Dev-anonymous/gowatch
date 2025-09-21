<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HttpToken
 * 
 * @property int $id
 * @property int $users_id
 * @property string $token
 * @property Carbon|null $date
 * 
 * @property User $user
 *
 * @package App\Models
 */
class HttpToken extends Model
{
	protected $table = 'http_token';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'users_id',
		'token',
		'date'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
