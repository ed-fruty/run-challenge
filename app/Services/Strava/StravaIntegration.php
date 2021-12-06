<?php

namespace App\Services\Strava;

use App\Models\Activity;
use App\Models\User;
use App\Services\Strava\DTO\UserActivityQuery;
use App\Services\Strava\DTO\UserActivityResponse;
use App\Services\Strava\DTO\UserTokenResponse;
use Carbon\Carbon;
use CodeToad\Strava\Strava;
use Illuminate\Support\Collection;

/**
 * @mixin Strava
 */
class StravaIntegration
{
    /**
     * @var Strava
     */
    private $strava;

    /**
     * @param Strava $strava
     */
    public function __construct(Strava $strava)
    {
        $this->strava = $strava;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->strava->$name(...$arguments);
    }

    /**
     * @param string $code
     * @return UserTokenResponse
     */
    public function token(string $code): UserTokenResponse
    {
        $token = $this->strava->token($code);

        return new UserTokenResponse($token);
    }

    /**
     * @param User $user
     * @param UserActivityQuery $query
     * @return mixed|array
     */
    public function userActivities(User $user, UserActivityQuery $query)
    {
        $this->actualizeToken($user);

        return $this->activities(
            $user->strava_access_token,
            $query->getPage(),
            $query->getPerPage(),
            $query->getBefore(),
            $query->getAfter()
        );
    }

    /**
     * @param User $user
     * @param UserActivityQuery $query
     * @return Collection|UserActivityResponse[]
     */
    public function getUserChallengeRuns(User $user, UserActivityQuery $query): Collection
    {
        $activities = $this->userActivities($user, $query);

        return collect($activities)
            ->filter(static function ($activity) {
                return $activity->type === 'Run';
            })
            ->filter(static function ($activity) {
                return $activity->distance >= config('app.challenge.min_distance');
            })
            ->filter(static function ($activity) {
                $startDate = Carbon::parse($activity->start_date);

                $challengeStartDate = Carbon::parse(config('app.challenge.start_date'));
                $challengeFinishDate = Carbon::parse(config('app.challenge.finish_date'));

                return $challengeStartDate->getTimestamp() <= $startDate->getTimestamp()
                    && $challengeFinishDate->getTimestamp() >= $startDate->getTimestamp();
            })
            ->filter(static function ($activity) {
                $speedMetersInSec = $activity->average_speed;
                $speedKmInHour = $speedMetersInSec * 3.6;

                return $speedKmInHour >= config('app.challenge.min_speed_km_per_hour');
            })
            ->filter(static function ($activity) {
                return Activity::query()->where('strava_id', $activity->id)->exists() === false;
            })
            ->map(static function ($activity) {
                return new UserActivityResponse($activity);
            });
    }

    /**
     * @param User $user
     */
    public function actualizeToken(User $user): void
    {
        if (now()->diffInMilliseconds($user->strava_token_expires_at, false) < 0) {
            // token has been expired
            // need to refresh
            $refresh = $this->strava->refreshToken($user->strava_refresh_token);

            $user->strava_access_token = $refresh->access_token;
            $user->strava_refresh_token = $refresh->refresh_token;
            $user->strava_token_expires_at = $refresh->expires_at;
            $user->save();
        }
    }
}
