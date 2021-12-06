<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|View
     */
    public function index()
    {
        $activities = auth()->user()->activities()
            ->latest()
            ->paginate();

        return view('argon.activities.index', [
            'activities' => $activities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|View
     */
    public function create()
    {
        return view('argon.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityRequest  $request
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function store(StoreActivityRequest $request): RedirectResponse
    {
        /** @var Activity $activity */
        $activity = $request->user()->activities()->create([
            'status' => Activity::STATUS_MODERATION,
            'source' => Activity::SOURCE_MANUAL,
            'distance' => $request->getDistanceInMeters(),
            'start_date' => $request->getStartDate(),
        ]);

        $image = $request->moveActivityImage($activity);

        $activity->image = $image;
        $activity->save();

        session()->flash('status', 'Пробежка успешно добавлена.');

        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response|RedirectResponse
     */
    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        session()->flash('status', 'Пробежка успешно удалена.');

        return redirect()->route('activities.index');
    }
}
