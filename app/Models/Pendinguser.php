<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pendinguser
 * 
 * @property int $id
 * @property string|null $email
 * @property string|null $data
 * @property Carbon|null $date
 * @property string|null $token
 *
 * @package App\Models
 */
class Pendinguser extends Model
{
	protected $table = 'pendinguser';
	public $timestamps = false;

	protected $dates = [
		'date'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'email',
		'data',
		'date',
		'token'
	];
}
