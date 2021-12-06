<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user): View
    {
        $user->distance = $user->activities->reduce(static function ($previous, Activity $activity) {
            return $activity->getDistanceInKm() + $previous;
        }, 0);


        $user->uniqueDates = $user->activities
            ->map(static function (Activity $activity) {
                return $activity->start_date->format('d.m.Y');
            })
            ->unique()
            ->count();

        return view('argon.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        return view('argon.users.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        auth()->user()->update([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'country' => $request->get('country'),
            'city' => $request->get('city')
        ]);

        if ($request->hasUploadedImage()) {
            $user = auth()->user();

            $image = $request->moveUserImage($user);

            $user->photo_url = $image;
            $user->save();
        }

        session()->flash('status', 'Профиль успешно обновлен.');

        return redirect()->route('users.show', auth()->user()->id);
    }
}
