<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Traits\imageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    use imageTrait;

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

    public function getData(User $user)
    {
        $data = $this->validated();


        if(!empty($data['image']))
        {
            $data['image'] = $this->uploadImages($this, 'image', 'uploads/userProfiles', $user->image);
        }else{
            $user->image;
        }

        return $data;
    }
}
