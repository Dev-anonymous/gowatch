<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Errorlog
 * 
 * @property int $id
 * @property string|null $data
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Errorlog extends Model
{
	protected $table = 'errorlog';
	public $timestamps = false;

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'data',
		'date'
	];
}
