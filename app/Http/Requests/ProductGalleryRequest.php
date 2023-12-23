<?php

namespace App\Http\Requests;

use App\Models\ProductGallery;
use App\Traits\imageTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProductGalleryRequest extends FormRequest
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
            'product_id' => ['required'],
            'images.*' => ['required', 'image', 'max:2048']
        ];
    }

    public function attributes()
    {
        return [
            'images.*' => __('Image')
        ];
    }

    public function getData(ProductGallery $productGallery)
    {
        $data = $this->validated();

        return $data;
    }
}
