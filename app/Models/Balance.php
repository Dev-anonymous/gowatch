<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Balance
 * 
 * @property int $id
 * @property int $users_id
 * @property float|null $amount
 * @property string|null $currency
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Balance extends Model
{
	protected $table = 'balance';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'amount' => 'float'
	];

	protected $fillable = [
		'users_id',
		'amount',
		'currency'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
