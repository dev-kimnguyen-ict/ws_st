<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;

class RegisterFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:5,100',
            'email' => 'required|email|between:3,255|unique:users',
            'password' => 'required|between:8,32|confirmed',
            'phone' => 'required|between:10,20',
            'address' => 'required|between:5,255',
            'avatar' => 'image|size:1024',
            'permiss' => 'required|numeric|between:1,3',
            'actived' => 'required|boolean',
            'blocked' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ tên không được để trống',
            'email.unique' => 'Email này đã có người sử dụng',
            'email.required' => 'Bạn cần điền email để đăng ký',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
            'phone.required' => 'Số điện thoại cần được nhập để liên hệ khi mua hàng',
            'address.required' => 'Địa chỉ không được phép để trống',
            'email.email' => 'Địa chỉ email không đúng định dạng email',
            'name.between' => 'Họ tên phải có độ dài từ :min - :max ký tự',
            'email.between' => 'Địa chỉ email phải có độ dài từ :min - :max ký tự',
            'password.between' => 'Mật khẩu cần có độ dài từ :min - :max ký tự',
            'phone.between' => 'Số điện thoại cần có độ dài từ :min - :max ký tự',
            'address.between' => 'Địa chỉ cần có độ dài từ :min - :max ký tự',
            'avatar.size' => 'Ảnh đại diện phải nhỏ hơn :size kb',
            'avatar.image' => 'Không đúng định dạng hình ảnh',
            'permiss.required' => 'Bạn cần chọn loại tài khoản',
            'permiss.numeric' => 'Không đúng định dạng số',
            'actived.required' => 'Bạn phải chọn trạng thái kích hoạt',
            'actived.boolean' => 'Sai định dạng dữ liệu',
            'blocked.required' => 'Bạn phải chọn trạng thái hoạt động',
            'blocked.boolean' => 'Sai định dạng dữ liệu',
        ];
    }
}
