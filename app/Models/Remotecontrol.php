<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Remotecontrol
 * 
 * @property int $id
 * @property string|null $actionname
 * @property string|null $action
 * @property int|null $success
 * @property string|null $errormessage
 * @property Carbon|null $date
 * @property int|null $fetched
 * @property int|null $fromadmin
 * @property string|null $result
 * @property int|null $retry
 * @property int $phone_id
 * 
 * @property Phone $phone
 *
 * @package App\Models
 */
class Remotecontrol extends Model
{
	protected $table = 'remotecontrol';
	public $timestamps = false;

	protected $casts = [
		'success' => 'int',
		'fetched' => 'int',
		'fromadmin' => 'int',
		'retry' => 'int',
		'phone_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'actionname',
		'action',
		'success',
		'errormessage',
		'date',
		'fetched',
		'fromadmin',
		'result',
		'retry',
		'phone_id'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
