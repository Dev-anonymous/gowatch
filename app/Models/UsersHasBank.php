<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersHasBank
 * 
 * @property int $id
 * @property int $users_id
 * @property int $bank_id
 * @property string|null $iban
 * @property string|null $titulaire
 * @property int|null $actif
 * 
 * @property Bank $bank
 * @property User $user
 *
 * @package App\Models
 */
class UsersHasBank extends Model
{
	protected $table = 'users_has_bank';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'bank_id' => 'int',
		'actif' => 'int'
	];

	protected $fillable = [
		'users_id',
		'bank_id',
		'iban',
		'titulaire',
		'actif'
	];

	public function bank()
	{
		return $this->belongsTo(Bank::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
