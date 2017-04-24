<?php

namespace App\Http\Requests\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class InsertCartRequest extends Request
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
        return Auth::guest() || isMember();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:products,id',
            'new_quatity' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => Lang::has('cart.id_required')
                ? Lang::get('cart.id_required')
                : 'Mã sản phẩm không được để trống!',
            'id.numeric' => Lang::has('cart.id_numeric')
                ? Lang::get('cart.id_numeric')
                : 'Sai định dạng dữ liệu',
            'id.exists' => Lang::has('cart.id_exists')
                ? Lang::get('cart.id_exists')
                : 'Không tồn tại sản phẩm',
            'new_quatity.numeric' => Lang::has('cart.new_quatity_numeric')
                ? Lang::get('cart.new_quatity_numeric')
                : 'Sai định dạng dữ liệu',
        ];
    }
}
