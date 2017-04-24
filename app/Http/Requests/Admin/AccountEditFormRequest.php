<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;

class AccountEditFormRequest extends Request
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
            'name' => 'between:5,100',
            'password' => 'between:8,32|confirmed',
            'phone' => 'between:10,20',
            'address' => 'between:5,255',
            'avatar' => 'size:1024|mimes:jpg,png,gif',
            'groupid' => 'required|numeric|between:1,3',
            'actived' => 'required|boolean',
            'blocked' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.between' => 'Họ tên phải có độ dài từ :min - :max ký tự',
            'password.between' => 'Mật khẩu phải có độ dài từ :min - :max ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp!',
            'phone.between' => 'Số điện thoại phải có độ dài từ :min - :max ký tự',
            'address.between' => 'Địa chỉ phải có độ dài từ :min - :max ký tự',
            'avatar.mimes' => 'Không đúng định dạng hình ảnh, vui lòng upload ảnh định dạng: jpg,png,gif dung lượng nhỏ hơn 1MB',
            'avatar.size' => 'Không đúng định dạng hình ảnh, vui lòng upload ảnh định dạng: jpg,png,gif dung lượng nhỏ hơn 1MB',
            'groupid.required' => 'Bạn cần chọn loại tài khoản',
            'groupid.numeric' => 'Không đúng định dạng số',
            'actived.required' => 'Bạn phải chọn trạng thái kích hoạt',
            'actived.boolean' => 'Sai định dạng dữ liệu',
            'blocked.required' => 'Bạn phải chọn trạng thái hoạt động',
            'blocked.boolean' => 'Sai định dạng dữ liệu',
        ];
    }
}
