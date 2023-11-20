<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class ChildCategoryRequest extends FormRequest
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
        $childId = $this->route('child_category.id');

        if($this->method() == "PUT")
        {
            return [
                'category_id'     => ['required', 'exists:categories,id'],
                'sub_category_id' => ['required', 'exists:sub_categories,id'],
                'name'            => ['required', 'min:3', 'max:25', 'unique:child_categories,name,' . $childId],
                'slug'            => ['string'],
                'status'          => ['required'],
            ];
        }

        return [
            'category_id'     => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
            'name'            => ['required', 'min:3', 'max:25', 'unique:child_categories,name'],
            'slug'            => ['string'],
            'status'          => ['required']
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'Category',
            'sub_category_id' => 'Sub Category'
        ];
    }

    public function getData()
    {
        $data = $this->validated();

        $data['slug'] = Str::slug($data['name'], '-');

        return $data;
    }
}
