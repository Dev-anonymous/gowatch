<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * 
 * @property int $id
 * @property int $subscription_id
 * @property Carbon|null $to
 * @property string|null $type
 * @property float|null $amount
 * @property string|null $currency
 * 
 * @property Subscription $subscription
 *
 * @package App\Models
 */
class History extends Model
{
	protected $table = 'history';
	public $timestamps = false;

	protected $casts = [
		'subscription_id' => 'int',
		'amount' => 'float'
	];

	protected $dates = [
		'to'
	];

	protected $fillable = [
		'subscription_id',
		'to',
		'type',
		'amount',
		'currency'
	];

	public function subscription()
	{
		return $this->belongsTo(Subscription::class);
	}
}
