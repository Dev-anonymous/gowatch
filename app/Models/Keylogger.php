<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Keylogger
 * 
 * @property int $id
 * @property int $phone_id
 * @property int|null $remote_id
 * @property string|null $text
 * @property string|null $package
 * @property Carbon|null $date
 * 
 * @property Phone $phone
 *
 * @package App\Models
 */
class Keylogger extends Model
{
	protected $table = 'keylogger';
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
		'text',
		'package',
		'date'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
