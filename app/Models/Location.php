<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * 
 * @property int $id
 * @property int|null $remote_id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property float|null $accuracy
 * @property Carbon|null $date
 * @property int $phone_id
 * 
 * @property Phone $phone
 *
 * @package App\Models
 */
class Location extends Model
{
	protected $table = 'locations';
	public $timestamps = false;

	protected $casts = [
		'remote_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float',
		'accuracy' => 'float',
		'phone_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'remote_id',
		'latitude',
		'longitude',
		'accuracy',
		'date',
		'phone_id'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
