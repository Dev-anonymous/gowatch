<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dailyaction
 * 
 * @property int $id
 * @property int $phone_id
 * @property int $remotecontrol_id
 * @property Carbon|null $date
 * 
 * @property Phone $phone
 * @property Remotecontrol $remotecontrol
 *
 * @package App\Models
 */
class Dailyaction extends Model
{
	protected $table = 'dailyaction';
	public $timestamps = false;

	protected $casts = [
		'phone_id' => 'int',
		'remotecontrol_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'phone_id',
		'remotecontrol_id',
		'date'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}

	public function remotecontrol()
	{
		return $this->belongsTo(Remotecontrol::class);
	}
}
