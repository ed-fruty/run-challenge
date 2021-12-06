<?php

namespace App\Http\Requests;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'distance' => ['required', 'numeric', 'min:3'],
            'start_date' => ['required', 'date'],
            'image' => ['required', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif']
        ];
    }

    /**
     * @return int
     */
    public function getDistanceInMeters(): int
    {
        $distance = str_replace(',', '.', $this->get('distance'));

        return (int) $distance * 1000;
    }

    /**
     * @return Carbon
     */
    public function getStartDate(): Carbon
    {
        return Carbon::parse($this->get('start_date'));
    }

    /**
     * @param Activity $activity
     * @return string
     */
    public function moveActivityImage(Activity $activity): string
    {
        $filename = $activity->id . '.' . $this->image->getClientOriginalExtension();

        $this->image->move(public_path('images/activities'), $filename);

        return $filename;
    }
}
