<?php

namespace App\Jobs;

use App\Models\Activity;
use App\Models\User;
use App\Services\Strava\DTO\UserActivityQuery;
use App\Services\Strava\DTO\UserActivityResponse;
use App\Services\Strava\StravaIntegration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LoadStravaActivities implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;
    /**
     * @var UserActivityQuery
     */
    public $query;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, UserActivityQuery $query)
    {
        $this->user = $user;
        $this->query = $query;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(StravaIntegration $strava)
    {
        $activities = $strava->getUserChallengeRuns($this->user, $this->query);

        $activities->each(function (UserActivityResponse $response) {

            $this->user->activities()->create([
                'distance' => $response->getDistance(),
                'start_date' => $response->getStartDateLocal(),
                'source' => Activity::SOURCE_STRAVA,
                'status' => Activity::STATUS_APPROVED,
                'speed_meters_in_sec' => $response->getAvgSpeed(),
                'strava_id' => $response->getId(),
                'strava_athlete_id' => $this->user->strava_id,
                'strava_start_date' => $response->getStartDate(),
                'strava_start_date_local' => $response->getStartDateLocal(),
                'strava_timezone' => $response->getTimeZone(),
                'strava_utc_offset' => $response->getUtcOffset(),
                'strava_moving_time' => $response->getMovingTime(),
            ]);
        });
    }
}
