<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $categoryId = $this->route('category.id');
        
        if($this->method() == "PUT")
        {
                return [
                    'name'   => ['required', 'string', 'min:2', 'max:20', 'unique:categories,name,' . $categoryId],
                    'slug'   => ['string'],
                    'icon'   => ['required' ,'not_in:empty'],
                    'status' =>['required']
                ];
        }

        return [
            'name'   => ['required', 'string', 'min:2', 'max:20', 'unique:categories,name'],
            'slug'   => ['string'],
            'icon'   => ['required' ,'not_in:empty'],
            'status' =>['required']
        ];
    }

    public function getData()
    {
        $data = $this->validated();

        $data['slug'] = Str::slug($data['name'], '-');

        return $data;
    }
}
