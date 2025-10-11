<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feedback
 * 
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $message
 * @property Carbon|null $date
 *
 * @package App\Models
 */
class Feedback extends Model
{
	protected $table = 'feedback';
	public $timestamps = false;

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'name',
		'phone',
		'email',
		'subject',
		'message',
		'date'
	];
}
