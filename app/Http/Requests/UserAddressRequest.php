<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserAddressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:100'],
            'phone' => ['required'],
            'country' => ['required'],
            'state' => ['required', 'max:50'],
            'city' => ['required', 'max:50'],
            'zip_code' => ['required', 'max:10'],
            'address' => ['required', 'max:200'],
            'comment' => ['nullable', 'max:100'],
            'default' => ['required']
        ];
    }

    public function getData()
    {
        $data = $this->validated();

        $data['user_id'] = Auth::user()->id;

        return $data;
    }
}
