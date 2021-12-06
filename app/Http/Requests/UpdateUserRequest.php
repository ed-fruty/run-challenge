<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route()->parameter('user')->id === auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'country' => ['string', 'max:32'],
            'city' => ['string', 'max:64'],
            'photo_url' => ['image', 'max:2048', 'mimes:jpg,jpeg,png,gif']
        ];
    }

    public function hasUploadedImage(): bool
    {
        return $this->photo_url && $this->photo_url instanceof UploadedFile;
    }

    /**
     * @param User $user
     * @return string
     */
    public function moveUserImage(User $user): string
    {
        $filename = $user->id . '.' . $this->photo_url->getClientOriginalExtension();

        $this->photo_url->move(public_path('images/users'), $filename);

        return '/images/users/' .$filename;
    }
}
