<?php

namespace App\Http\Requests;

use App\Models\Vendor;
use App\Traits\imageTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class VendorProfileRequest extends FormRequest
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
        // $vendorId = $this->route('vendor_profile.id');

        return [

            'user_id' => ['exists:users,id'],
            'banner' => ['nullable', 'image', 'max:2000'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'address' => ['nullable', 'max:255'],
            'shop_description' => ['nullable', 'max:255'],
            'store_status' => ['required'],
            'facebook' => ['nullable', 'url'],
            'x' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url']

        ];
    }

    public function getData(Vendor $vendor)
    {
        $data = $this->validated();

        $data['user_id'] = Auth::user()->id;

        if(!empty($data['banner']))
        {
            $data['banner'] = $this->uploadImages($this, 'banner', 'uploads/vendors', $vendor->banner);

        }else{

            $vendor->banner;
        }


        return $data;
    }
}
