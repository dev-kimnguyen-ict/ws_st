<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class SearchRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'q' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'q.required' => Lang::has('search.key_required')
                ? Lang::get('search.key_required')
                : 'Vui lòng nhập từ khóa tìm kiếm',
        ];
    }
}
