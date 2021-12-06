<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string surname
 * @property Carbon email_verified_at
 *
 * @property int strava_id
 * @property string strava_access_token
 * @property string strava_refresh_token
 * @property Carbon strava_token_expires_at
 * @property string strava_scopes
 * @property Carbon strava_last_synced_at
 *
 * @property string photo_url
 * @property string country
 * @property string city
 *
 * @property boolean is_admin
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property Activity[]|Collection activities
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'email_verified_at',

        'strava_id',
        'strava_access_token',
        'strava_refresh_token',
        'strava_token_expires_at',
        'strava_scopes',
        'strava_last_synced_at',

        'photo_url',
        'country',
        'city',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'strava_token_expires_at' => 'datetime',
        'strava_last_synced_at' => 'datetime',
        'strava_id' => 'int',
        'is_admin' => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
