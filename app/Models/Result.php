<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Result
 * 
 * @property int $id
 * @property int $remotecontrol_id
 * @property Carbon|null $date
 * @property string|null $data
 * 
 * @property Remotecontrol $remotecontrol
 *
 * @package App\Models
 */
class Result extends Model
{
	protected $table = 'result';
	public $timestamps = false;

	protected $casts = [
		'remotecontrol_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'remotecontrol_id',
		'date',
		'data'
	];

	public function remotecontrol()
	{
		return $this->belongsTo(Remotecontrol::class);
	}
}
