<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Call
 * 
 * @property int $id
 * @property int|null $remote_id
 * @property string|null $type
 * @property float|null $duration
 * @property string|null $number
 * @property string|null $name
 * @property Carbon|null $date
 * @property int $phone_id
 * 
 * @property Phone $phone
 *
 * @package App\Models
 */
class Call extends Model
{
	protected $table = 'calls';
	public $timestamps = false;

	protected $casts = [
		'remote_id' => 'int',
		'duration' => 'float',
		'phone_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'remote_id',
		'type',
		'duration',
		'number',
		'name',
		'date',
		'phone_id'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
