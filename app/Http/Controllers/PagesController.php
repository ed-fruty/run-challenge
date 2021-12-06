<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $latest = Activity::query()->with('user')->latest()->take(10)->get();

        return view('argon.pages.index', [
            'latest' => $latest
        ]);
    }

    public function rating()
    {
        $rating = User::query()->with('activities')->get()
            ->map(static function (User $user) {
                $user->uniqueDates = $user->activities
                    ->pluck('start_date')
                    ->map(function ($v) { return $v->format('d.m.Y');})
                    ->unique()
                    ->count();

                $user->distance = round($user->activities->sum('distance') / 1000, 2);

                return $user;
            });

        return view('argon.pages.rating', [
            'rating' => $rating,
        ]);
    }


    public function rules()
    {
        return view('argon.pages.rules');
    }

    public function cities()
    {
        $cities = Activity::query()
            ->select([
                'city',
                'country',
                \DB::raw('sum(distance) as distance'),
                \DB::raw('count(id) as activities')
            ])
            ->groupBy('city')
            ->get();

        return view('argon.pages.cities', [
            'cities' => $cities
        ]);
    }
}
