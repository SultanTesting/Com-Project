<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Traits\imageTrait;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        $brandId = $this->route('brand.id');

        if($this->method() == "PUT")
        {
            return [
                'name'      => ['required', 'string', 'min:4', 'max:25', 'unique:brands,name,' . $brandId],
                'logo'      => ['nullable', 'image', 'max:2000'],
                'status'    => ['required'],
                'featured'  => ['required']
            ];

        }else{

            return [
                'name'      => ['required', 'string', 'min:4', 'max:25', 'unique:brands,name'],
                'logo'      => ['nullable', 'image', 'max:2000'],
                'status'    => ['required'],
                'featured'  => ['required']
            ];
        }


    }

    public function getData(Brand $brand)
    {
        $data = $this->validated();

        if(!empty($data['logo']))
        {
            $data['logo'] = $this->uploadImages($this, 'logo', '/uploads/brands', $brand->logo);
        }else{
            $brand->logo;
        }

        $data['slug'] = Str::slug($data['name'], '-');

        return $data;
    }
}
