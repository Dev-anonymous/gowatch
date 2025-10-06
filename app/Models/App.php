<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class App
 * 
 * @property int $id
 * @property int|null $remote_id
 * @property string|null $name
 * @property string|null $package
 * @property Carbon|null $installdate
 * @property int $phone_id
 * @property int|null $is_uninstalled
 * @property Carbon|null $date
 * 
 * @property Phone $phone
 *
 * @package App\Models
 */
class App extends Model
{
	protected $table = 'apps';
	public $timestamps = false;

	protected $casts = [
		'remote_id' => 'int',
		'phone_id' => 'int',
		'is_uninstalled' => 'int'
	];

	protected $dates = [
		'installdate',
		'date'
	];

	protected $fillable = [
		'remote_id',
		'name',
		'package',
		'installdate',
		'phone_id',
		'is_uninstalled',
		'date'
	];

	public function phone()
	{
		return $this->belongsTo(Phone::class);
	}
}
