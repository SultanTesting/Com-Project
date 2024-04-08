<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Traits\imageTrait;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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

        if($this->method() == "PUT")
        {
            return [
                "name" => ['required', 'min:2', 'max:100'],
                "thumb_image" => ['nullable', 'image', 'max:3000'],
                "category_id" => ['required'],
                "sub_category_id" => ['nullable'],
                "child_category_id" => ['nullable'],
                "brand_id" => ['required'],
                "quantity" => ['required', 'integer', 'min:1'],
                "short_description" => ['required', 'min:10', 'max:255'],
                "long_description" => ['nullable', 'min:20', 'max:1000'],
                "SKU" => ['nullable'],
                "video_link" => ['nullable', 'url'],
                "price" => ['required', 'min:1', 'integer'],
                "offer_price" => ['nullable'],
                'offer_start_date' => ['nullable', 'date', 'after_or_equal:today'],
                'offer_end_date' => ['nullable', 'date', 'after:offer_start_date'],
                "product_type" => ['required'],
                "seo_title" => ['nullable', 'max:100'],
                "seo_description" => ['nullable', 'max:255'],
                "status" => ['required'],
            ];
        }

            return [
                "name" => ['required', 'min:2', 'max:100'],
                "thumb_image" => ['required', 'image', 'max:3000'],
                "category_id" => ['required'],
                "sub_category_id" => ['nullable'],
                "child_category_id" => ['nullable'],
                "brand_id" => ['required'],
                "quantity" => ['required', 'integer', 'min:1'],
                "short_description" => ['required', 'min:10', 'max:255'],
                "long_description" => ['nullable', 'min:20', 'max:1000'],
                "SKU" => ['nullable'],
                "video_link" => ['nullable', 'url'],
                "price" => ['required', 'min:1', 'integer'],
                "offer_price" => ['nullable'],
                'offer_start_date' => ['nullable', 'date', 'after_or_equal:today'],
                'offer_end_date' => ['nullable', 'date', 'after:offer_start_date'],
                "product_type" => ['required'],
                "seo_title" => ['nullable', 'max:100'],
                "seo_description" => ['nullable', 'max:255'],
                "status" => ['required'],
            ];
    }

    public function attributes()
    {
        return [
            "category_id" => __('Category'),
            "sub_category_id" => __('Sub-Category'),
            "child_category_id" => __('Child-Category'),
            "brand_id" => __('Brand'),
            "offer_price" => __('Offer Price'),
            'offer_start_date' => __('Offer Start Date'),
            'offer_end_date' => __('Offer End Date'),
            'product_type' => __('product type'),
        ];
    }

    public function getData(Product $product)
    {
        $data = $this->validated();

        if($this->method() == 'PUT')
        {
            $data['vendor_id'] = $product->vendor_id;
        }else{

            $data['vendor_id'] = Auth::user()->vendor->id;
        }


        $data['slug'] = Str::slug($data['name'], '-');

        if(!empty($data['thumb_image']))
        {
            $data['thumb_image'] = $this->uploadImages($this, 'thumb_image', makeDirectory('products', $data['slug']), $product->thumb_image);

        }else{

            $product->thumb_image;
        }


        return $data;


    }
}
