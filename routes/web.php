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

Route::middleware('auth')
    ->group(static function () {
        Route::get('/users/{user}/edit')
            ->name('users.edit')
            ->uses([UsersController::class, 'edit']);

        Route::patch('/users/{user}')
            ->name('users.update')
            ->uses([UsersController::class, 'update']);

        Route::resource('activities', ActivityController::class, [
            'except' => ['edit', 'update', 'show']
        ]);
    });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
