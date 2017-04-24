<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;

class UpdateProductRequest extends Request
{
    protected $forceJsonResponse = true;

    public function response(array $errors)
    {
        if ($this->forceJsonResponse || $this->ajax() || $this->wantsJson()) {
            return response()->json($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }

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
            'ten_san_pham' => 'required|between:5,255',
            'danh_muc' => 'numeric',
            'gia_nhap' => 'numeric|min:0',
            'gia_ban' => 'numeric|min:0',
            'giam_gia' => 'numeric|between:0,100',
            'trang_thai' => 'boolean',
            'danh_dau' => 'numeric|between:0,2',
            'mo_ta' => 'between:10,155',
            'bai_viet' => 'between:20,255',
            'seo_tieu_de' => 'required|max:70',
            'seo_mo_ta' => 'max:160',
            'seo_alias' => 'required|alpha_dash',
        ];
    }

    public function messages()
    {
        return [
            'ten_san_pham.required' => 'Tên sản phẩm không được để trống',
            'ten_san_pham.between' => 'Tên sản phẩm phải có độ dài từ :min - :max ký tự',
            'danh_muc.numeric' => 'Sai định dạng dữ liệu danh mục sản phẩm!',
            'gia_nhap.numeric' => 'Giá nhập phải là một số!',
            'gia_nhap.min' => 'Giá nhập phải lớn hơn :min!',
            'gia_ban.numeric' => 'Giá bán phải là một số!',
            'gia_ban.min' => 'Giá bán phải lớn hơn :min!',
            'giam_gia.numeric' => 'Giảm giá phải là một số!',
            'giam_gia.between' => 'Giảm giá phải có độ dài từ :min - :max ký tự',
            'trang_thai.boolean' => 'Sai định dạng dữ liệu',
            'danh_dau.numeric' => 'Sai định dạng dữ liệu',
            'danh_dau.between' => 'Đánh dấu không hợp lệ',
            'mo_ta.between' => 'Mô tả phải có độ dài từ :min - :max ký tự',
            'bai_viet.between' => 'Bài viết phải có độ dài từ :min - :max ký tự',
            'seo_tieu_de.required' => 'Thẻ tiêu đề không được để trống',
            'seo_tieu_de.max' => 'Vượt quá :max ký tự cho phép',
            'seo_mo_ta.max' => 'Vượt quá :max ký tự cho phép',
            'seo_alias.required' => 'Bí danh không được để trống',
            'seo_alias.alpha_dash' => 'Bí danh sai định dạng',
        ];
    }
}
