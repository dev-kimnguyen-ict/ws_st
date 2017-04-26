<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'price_number',
            'discount' => 'numeric|between:0,100',
            'active' => 'boolean',
            'mark' => 'numeric|between:0,2',
            'seo_title' => 'required|',
            'seo_alias' => [
                'required',
                'alpha_dash',
                Rule::unique('seos', 'alias')->whereNull('deleted_at'),
            ],
        ];
    }
}
