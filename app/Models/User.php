<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $derniere_connexion
 * @property string|null $phone
 * @property string|null $avatar
 * @property string $user_role
 * @property int|null $users_id
 *
 * @property User|null $user
 * @property Collection|Balance[] $balances
 * @property Collection|HttpToken[] $http_tokens
 * @property Collection|Phone[] $phones
 * @property Collection|Presubscription[] $presubscriptions
 * @property Collection|Recovery[] $recoveries
 * @property Collection|Sponsorpay[] $sponsorpays
 * @property Collection|User[] $users
 * @property Collection|Withdraw[] $withdraws
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $casts = [
        'users_id' => 'int'
    ];

    protected $dates = [
        'email_verified_at',
        'derniere_connexion'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'derniere_connexion',
        'phone',
        'avatar',
        'user_role',
        'users_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function balances()
    {
        return $this->hasMany(Balance::class, 'users_id');
    }

    public function http_tokens()
    {
        return $this->hasMany(HttpToken::class, 'users_id');
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'users_id');
    }

    public function presubscriptions()
    {
        return $this->hasMany(Presubscription::class, 'users_id');
    }

    public function recoveries()
    {
        return $this->hasMany(Recovery::class, 'users_id');
    }

    public function sponsorpays()
    {
        return $this->hasMany(Sponsorpay::class, 'users_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'users_id');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'users_id');
    }
}
