<?php

namespace App\Http\Requests;

use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            "banner" => ['nullable', 'image', 'max:2000'],
            "title"  => ['required', 'min:6', 'max:25'],
            "type"   => ['string', 'max:200'],
            "starting_price" => ['required', 'max:200000'],
            "url"    => ['required', 'url', 'max:200'],
            "serial" => ['required', 'max:50'],
            "status" => ['required']
        ];
    }

    public function getData()
    {

        $data = $this->validated();

        $image = $this->banner;
        $imageName = date("Y-m-d").rand(256,10000).'_'.$image->getClientOriginalName();
        $image->move(public_path('uploads/products'), $imageName);

        $data['banner'] = "/uploads/products/".$imageName;

        return $data;
    }
}
