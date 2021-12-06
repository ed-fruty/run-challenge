<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\StravaController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/auth/strava/redirect')
    ->name('auth.strava.redirect')
    ->uses([StravaController::class, 'redirect']);

Route::get('/auth/strava/callback')
    ->name('auth.strava.callback')
    ->uses([StravaController::class, 'callback']);

//Route::any('/strava-callback-debug', static function(\Illuminate\Http\Request  $request) {
//    dump(
//        Strava::token($request->code),
//        $request->all(),
//        $request->headers->all(),
//        $request
//    );
//});
//
//
//Route::get('/auth/strava', static function () {
//    return Strava::authenticate($scope='read_all,profile:read_all,activity:read_all');
//})->name('auth.strava');


Route::get('/strava/activities', static function (\App\Services\Strava\StravaIntegration $strava) {
    /** @var \App\Models\User $user */
    $user = \App\Models\User::query()->first();

    $activities = $strava->getUserChallengeRuns($user, new \App\Services\Strava\DTO\UserActivityQuery());

    $activities->each(static function (\App\Services\Strava\DTO\UserActivityResponse $response) use ($user) {

        $user->activities()->create([
            'distance' => $response->getDistance(),
            'start_date' => $response->getStartDateLocal(),
            'source' => \App\Models\Activity::SOURCE_STRAVA,
            'status' => \App\Models\Activity::STATUS_APPROVED,
            'speed_meters_in_sec' => $response->getAvgSpeed(),
            'strava_id' => $response->getId(),
            'strava_athlete_id' => $user->strava_id,
            'strava_start_date' => $response->getStartDate(),
            'strava_start_date_local' => $response->getStartDateLocal(),
            'strava_timezone' => $response->getTimeZone(),
            'strava_utc_offset' => $response->getUtcOffset(),
        ]);
    });
});


Route::get('/')
    ->name('pages.index')
    ->uses([PagesController::class, 'index']);

Route::get('/pages/rating')
    ->name('pages.rating')
    ->uses([PagesController::class, 'rating']);

Route::get('/pages/rules')
    ->name('pages.rules')
    ->uses([PagesController::class, 'rules']);


Route::get('/pages/cities')
    ->name('pages.cities')
    ->uses([PagesController::class, 'cities']);

Route::get('/users/{user}')
    ->name('users.show')
    ->uses([UsersController::class, 'show']);

Route::get('/users/{user}/edit')
    ->name('users.edit')
    ->uses([UsersController::class, 'edit']);

Route::patch('/users/{user}')
    ->name('users.update')
    ->uses([UsersController::class, 'update']);

Route::resource('activities', ActivityController::class, [
    'except' => ['edit', 'update', 'show']
]);

Route::get('/strava/detailed-activity', static function (\App\Services\Strava\StravaIntegration $strava) {
    $user = \App\Models\User::query()->first();

    $activity = $strava->activity($user->strava_access_token, 6340721338);

    dd($activity);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
