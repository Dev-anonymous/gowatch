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
 * @property string|null $package
 * @property string|null $text
 * @property Carbon|null $date
 * @property int|null $remote_id
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
		'package',
		'text',
		'date',
		'remote_id'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
