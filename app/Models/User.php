<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @method static updateOrCreate(array $array, array $array1)
 * @method static find(int $id)
 * @method static create(array $array)
 * @method static where(string $columnName, string $operator, $value)
 * @property Role[] roles
 * @property BloodType bloodType
 * @property Certificate[] certificates
 * @property bool hasRole
 * @property int id
 * @property int blood_type_id
 * @property string name
 * @property string email
 * @property string password
 * @property DateTime created_at
 * @property DateTime updated_at
 * @property DateTime last_login
 * @property DateTime email_verified_at
 * @property string gender
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'email_verified_at',
        'blood_type_id',
        'last_login',
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


    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        if ($this->roles()->where('label', $role)->first()) {
            return true;
        }
        return false;
    }

    /**
     * @return BelongsToMany
     */
    public function certificates(): BelongsToMany
    {
        return $this->belongsToMany(Certificate::class, 'user_certificates', 'user_id', 'certificate_id');
    }

    /**
     * @return HasOne
     */
    public function bloodType(): HasOne
    {
        return $this->hasOne(BloodType::class,'id','blood_type_id');
    }

}
