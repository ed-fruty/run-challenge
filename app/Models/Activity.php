<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int id
 * @property int user_id
 * @property int distance
 * @property Carbon start_date
 * @property string source
 * @property int status
 * @property string|null speed_meters_in_sec
 * @property string image
 *
 * @property integer strava_id
 * @property integer strava_athlete_id
 * @property Carbon strava_start_date
 * @property Carbon strava_start_date_local
 * @property string strava_timezone
 * @property int strava_utc_offset
 * @property int strava_moving_time
 *
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 */
class Activity extends Model
{
    use HasFactory;

    public const STATUS_APPROVED = 1;
    public const STATUS_MODERATION = 0;

    public const SOURCE_STRAVA = 'strava';
    public const SOURCE_MANUAL = 'manual';

    protected $fillable = [
        'distance',
        'start_date',
        'source',
        'status',
        'image',
        'speed_meters_in_sec',
        'strava_id',
        'strava_athlete_id',
        'strava_start_date',
        'strava_start_date_local',
        'strava_timezone',
        'strava_utc_offset',
        'strava_moving_time',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'strava_start_date' => 'datetime',
        'strava_start_date_local' => 'datetime',
        'strava_id' => 'int',
        'strava_athlete_id' => 'int',
        'distance' => 'int',
        'status' => 'boolean',
        'strava_utc_offset' => 'int',
        'strava_moving_time' => 'int',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTemp(): string
    {
        if (! $this->strava_moving_time) {
            return '';
        }

        //3563 / 60 / (10267.3 / 1000)
        $minutes = (int) ($this->strava_moving_time / 60 / ($this->distance / 1000));
        $seconds = (int) (60 * (($this->strava_moving_time / 60 / ($this->distance / 1000)) - $minutes));

        return $minutes . ':' . $seconds;
    }

    /**
     * @return float
     */
    public function getDistanceInKm(): float
    {
        return round($this->distance / 1000, 2);
    }

    /**
     * @return bool
     */
    public function isManual(): bool
    {
        return $this->source === self::SOURCE_MANUAL;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->status;
    }

    public function getFullImage(): string
    {
        return '/images/activities/' . $this->image;
    }
}
