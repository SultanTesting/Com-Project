<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'name'        => ['required', 'min:3', 'max:25', 'unique:sub_categories,name'],
            'slug'        => ['string'],
            'status'      => ['required']
        ];
    }

    public function attributes()
    {
        return ['category_id' => 'Category'];
    }

    public function getData()
    {
        $data = $this->validated();

        $data['slug'] = Str::slug($data['name'], '-');

        return $data;
    }
}
