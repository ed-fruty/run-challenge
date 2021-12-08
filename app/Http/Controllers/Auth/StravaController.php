<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\LoadStravaActivities;
use App\Models\User;
use App\Services\Strava\DTO\UserActivityQuery;
use App\Services\Strava\DTO\UserTokenResponse;
use App\Services\Strava\StravaIntegration;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class StravaController extends Controller
{
    /**
     * @var StravaIntegration
     */
    private $strava;

    /**
     * @param StravaIntegration $strava
     */
    public function __construct(StravaIntegration $strava)
    {
        $this->strava = $strava;
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function redirect()
    {
        return $this->strava->authenticate();
    }

    /**
     * @param Request $request
     * @param Dispatcher $bus
     * @return RedirectResponse
     */
    public function callback(Request $request, Dispatcher $bus): RedirectResponse
    {
        $attributes = $request->only('code', 'scope', 'error');

        if (isset($attributes['error'])) {
            return redirect()->route('pages.index');
        }

        try {
            $userToken = $this->strava->token((string) $attributes['code']);
        } catch (\Throwable $exception) {
            session()->flash('status', 'Что-то пошло не так.');

            return redirect()->route('pages.index');
        }

        /** @var User $user */
        $user = auth()->user() ?: User::query()->where('strava_id', $userToken->getId())->first();

        if ($user) {
            $user->update([
                'strava_id' => $userToken->getId(),
                'strava_access_token' => $userToken->getAccessToken(),
                'strava_refresh_token' => $userToken->getRefreshToken(),
                'strava_token_expires_at' => $userToken->getExpireAt(),
                'strava_scopes' => $attributes['scope'],
                'photo_url' => $userToken->getProfile(),
            ]);
        } else {
            $user = User::query()->create([
                'name' => $userToken->getFirstName(),
                'surname' => $userToken->getLastName(),
                'email' => $userToken->getEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt($userToken->getId()),

                'strava_id' => $userToken->getId(),
                'strava_access_token' => $userToken->getAccessToken(),
                'strava_refresh_token' => $userToken->getRefreshToken(),
                'strava_token_expires_at' => $userToken->getExpireAt(),
                'strava_scopes' => $attributes['scope'],
                //'strava_last_synced_at' => Carbon::parse('2020-01-01 00:00:00'),

                'photo_url' => $userToken->getProfile(),
                'country' => $userToken->getCountry(),
                'city' => $userToken->getCity(),

            ]);
        }

        auth()->login($user);

        $query = UserActivityQuery::createForUser($user);

        $bus->dispatch(new LoadStravaActivities($user, $query));

        return redirect()->route('home');
    }
}
