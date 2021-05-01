<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const GENDER_NONE = 0;
    const GENDER_MAN = 1;
    const GENDER_WOMAN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'image_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getGenderAttribute($value)
    {
        switch ($value) {
            case self::GENDER_NONE:
                return '不明';
            case self::GENDER_MAN:
                return '男性';
            case self::GENDER_WOMAN:
                return '女性';
            default:
                return '';
        }
    }

    public function setGenderAttribute($value)
    {
        switch ($value) {
            case '不明':
                $this->attributes['gender'] = 0;
                break;
            case '男性':
                $this->attributes['gender'] = 1;
                break;
            case '女性':
                $this->attributes['gender'] = 2;
                break;
            default:
                $this->attributes['gender'] = null;
        }
    }
}
