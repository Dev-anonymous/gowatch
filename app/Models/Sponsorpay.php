<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sponsorpay
 * 
 * @property int $id
 * @property int $users_id
 * @property Carbon|null $date
 * @property float|null $amount
 * @property string|null $currency
 * @property string|null $type
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Sponsorpay extends Model
{
	protected $table = 'sponsorpay';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'amount' => 'float'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'users_id',
		'date',
		'amount',
		'currency',
		'type'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
