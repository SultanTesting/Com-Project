<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'  => ['required', 'max:30'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'image' => ['nullable', 'image', 'max:2048']
        ];
    }

    public function getData($request)
    {
        $data = $this->validated();

        $user = $request->user();

        if($request->hasFile('image'))
        {
            // Delete Old Photo if exists
            if(File::exists(public_path($user->image)))
            {
                File::delete(public_path($user->image));
            }

            // Upload New One
            $image = $request->image;
            $imageName = date("Y-m-d").rand(255,10000).'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/userProfiles'), $imageName);

            $data['image'] = "/uploads/userProfiles/".$imageName;
        }

        return $data;
    }
}
