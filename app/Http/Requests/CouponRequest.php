<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        $couponId = $this->route('coupon.id');

        if($this->method() == 'POST')
        {
            return [
                'name' =>       ['required', 'max:255', 'unique:coupons,name'],
                'code' =>       ['required', 'max:255', 'unique:coupons,code'],
                'quantity' =>   ['required', 'integer'],
                'max_use' =>    ['required', 'integer'],
                'start_date' => ['required' , 'date', 'after_or_equal:today'],
                'end_date' =>   ['required' , 'date', 'after:start_date'],
                'discount' =>   ['required', 'integer'],
                'discount_type' =>  ['required'],
                'status' =>         ['required']
            ];

        }else{

            return [
                'name' =>       ['required', 'max:255', 'unique:coupons,name,' . $couponId],
                'code' =>       ['required', 'max:255', 'unique:coupons,code,' . $couponId],
                'quantity' =>   ['required', 'integer'],
                'max_use' =>    ['required', 'integer'],
                'start_date' => ['required' , 'date', 'after_or_equal:today'],
                'end_date' =>   ['required' , 'date', 'after:start_date'],
                'discount' =>   ['required', 'integer'],
                'discount_type' =>  ['required'],
                'status' =>         ['required']
            ];
        }

    }

    public function getData()
    {
        $data = $this->validated();

        if($this->method() == 'POST')
        {
            $data['total_used'] = 0;
        }

        return $data;
    }
}
