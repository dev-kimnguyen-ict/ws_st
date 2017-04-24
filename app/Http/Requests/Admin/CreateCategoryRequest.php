<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;

class CreateCategoryRequest extends Request
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
            'ten_danh_muc' => 'required|between:2,255',
            'danh_muc_cha' => 'numeric',
            'trang_thai' => 'boolean',
            'mo_ta' => 'between:5,255',
            'seo_tieu_de' => 'required|max:70',
            'seo_mo_ta' => 'max:160',
            'seo_alias' => 'required|alpha_dash|unique:seos,alias',
        ];
    }

    public function messages()
    {
        return [
            'ten_danh_muc.required' => 'Tên danh mục không được để trống',
            'ten_danh_muc.between' => 'Tên danh mục phải có độ dài từ :min - :max ký tự',
            'danh_muc_cha.numeric' => 'Sai định dạng dữ liệu',
            'trang_thai.boolean' => 'Sai định dạng dữ liệu',
            'mo_ta.between' => 'Mô tả phải cần có độ dài từ :min - :max ký tự, bạn cũng có thể để trống phần mô tả!',
            'seo_tieu_de.required' => 'Thẻ tiêu đề không được để trống',
            'seo_tieu_de.max' => 'Vượt quá :max ký tự cho phép',
            'seo_mo_ta.max' => 'Vượt quá :max ký tự cho phép',
            'seo_alias.required' => 'Bí danh không được để trống',
            'seo_alias.alpha_dash' => 'Bí danh sai định dạng',
            'seo_alias.unique' => 'Bí danh này đã tồn tại, vui lòng chọn bí danh khác',
        ];
    }
}
