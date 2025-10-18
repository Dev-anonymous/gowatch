<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Callrecorder
 * 
 * @property int $id
 * @property int $phone_id
 * @property string|null $file
 * @property Carbon|null $date
 * @property string|null $source
 * @property string|null $path
 * 
 * @property Phone $phone
 *
 * @package App\Models
 */
class Callrecorder extends Model
{
	protected $table = 'callrecorder';
	public $timestamps = false;

	protected $casts = [
		'phone_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'phone_id',
		'file',
		'date',
		'source',
		'path'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
