<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * 
 * @property int $id
 * @property int $phone_id
 * @property int $remote_id
 * @property string|null $appname
 * @property string|null $title
 * @property string|null $body
 * @property Carbon|null $date
 * 
 * @property Phone $phone
 *
 * @package App\Models
 */
class Notification extends Model
{
	protected $table = 'notification';
	public $timestamps = false;

	protected $casts = [
		'phone_id' => 'int',
		'remote_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'phone_id',
		'remote_id',
		'appname',
		'title',
		'body',
		'date'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
