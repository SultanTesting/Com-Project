<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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

    public function getData()
    {
        $data = $this->validated();

        return $data;
    }
}
