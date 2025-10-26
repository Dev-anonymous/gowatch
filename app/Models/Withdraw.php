<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Withdraw
 * 
 * @property int $id
 * @property int $users_id
 * @property float|null $amount
 * @property string|null $currency
 * @property Carbon|null $date
 * @property string|null $number
 * @property int|null $status
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Withdraw extends Model
{
	protected $table = 'withdraw';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'amount' => 'float',
		'status' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'users_id',
		'amount',
		'currency',
		'date',
		'number',
		'status'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
