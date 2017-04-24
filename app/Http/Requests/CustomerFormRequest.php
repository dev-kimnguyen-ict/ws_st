<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'required|between:3,100',
            'address' => 'required|between:10,255',
            'phone' => 'required|between:10,20',
            'email' => 'required|email|between:5,255',
            'note' => 'min:10',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Vui không được để trống!',
            'fullname.between' => 'Họ tên phải có độ dài từ :min đến :max ký tự!',
            'address.required' => 'Vui không được để trống!',
            'address.between' => 'Địa chỉ nhận hàng phải có độ dài từ :min đến :max ký tự!',
            'email.required' => 'Vui lòng nhập email, chúng tôi cần email để xác thực và thông báo trạng thái đơn hàng của bạn!',
            'email.email' => 'Sai định dạng email!',
            'note' => 'Chú thích tối thiểu phải :min ký tự, bạn có thể bỏ trống trường này!',
        ];
    }
}
