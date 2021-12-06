<?php

namespace App\Services\Strava\DTO;

use Carbon\Carbon;
use stdClass;

class UserActivityResponse
{
    /**
     * @var stdClass
     */
    private $activity;

    /**
     * @param stdClass $activity
     */
    public function __construct(stdClass $activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->activity->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->activity->id;
    }

    /**
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return Carbon::parse($this->activity->start_date);
    }

    /**
     * @return Carbon
     */
    public function getStartDateLocal(): Carbon
    {
        return Carbon::parse($this->activity->start_date_local);
    }

    /**
     * @return string
     */
    public function getTimeZone(): string
    {
        return (string) $this->activity->timezone;
    }

    /**
     * @return int
     */
    public function getUtcOffset(): int
    {
        return (int) $this->activity->utc_offset;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return (int) $this->activity->distance;
    }

    /**
     * @return string
     */
    public function getAvgSpeed(): string
    {
        return (string) $this->activity->average_speed;
    }

    /**
     * @return int
     */
    public function getMovingTime(): int
    {
        return (int) $this->activity->moving_time;
    }
}
