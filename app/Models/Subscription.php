<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * 
 * @property int $id
 * @property Carbon|null $to
 * @property int|null $active
 * @property Carbon|null $date
 * @property int $phone_id
 * @property string $type
 * 
 * @property Phone $phone
 * @property Collection|History[] $histories
 *
 * @package App\Models
 */
class Subscription extends Model
{
	protected $table = 'subscription';
	public $timestamps = false;

	protected $casts = [
		'active' => 'int',
		'phone_id' => 'int'
	];

	protected $dates = [
		'to',
		'date'
	];

	protected $fillable = [
		'to',
		'active',
		'date',
		'phone_id',
		'type'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}

	public function histories()
	{
		return $this->hasMany(History::class);
	}
}
