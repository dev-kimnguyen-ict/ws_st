<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
        /** @var Category $category */
        $category = $this->route('category') ? $this->route('category')->load('seo') : null;
        $uniqueSeoAlias = Rule::unique('seos', 'alias')->whereNull('deleted_at');

        if ($category) {
            $uniqueSeoAlias->ignore($category->seo->getKey());
        }

        return [
            'name' => 'required',
            'parent_id' => 'numeric',
            'active' => 'boolean',
            'seo_title' => 'required',
            'seo_alias' => [
                'required',
                'alpha_dash',
                $uniqueSeoAlias,
            ],
        ];
    }
}
