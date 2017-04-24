<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\TemplateViews;
use App\Http\Requests\Cart\InsertCartRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use TemplateViews;

    public function insert(InsertCartRequest $request)
    {
        $cart = $request->session()->get(SS_CART, null);
        $product = Product::find($request->input('id'));

        $product->setQuatity(1);

        if ($cart == null) {
            $cart = collect([$product]);
        } else {
            $temp = $cart->get($request->input('id'));
            if ($temp == null) {
                $cart = $cart->push($product);
            } else {
                $temp->incre();
            }
        }
        $request->session()->put(SS_CART, $cart->keyBy('id'));

        $result = [
            'message' => "Thêm sản phẩm '$product->name' thành công!",
            'length' => $cart->sum('quatity'),
        ];
        return response()->json($result, 200);
    }

    public function remove(InsertCartRequest $request)
    {
        $cart = $request->session()->get(SS_CART, null);
        if ($cart != null) {
            $cart->forget($request->input('id'));
            if ($cart->sum('quatity') == 0) {
                $request->session()->forget(SS_CART);
            }
            return response()->json([
                'length' => $cart->sum('quatity'),
                'amount' => number_format($cart->sum('amount')),
                'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công!',
            ], 200);
        } else {
            return response()->json(['error' => 'Chưa có sản phẩm nào trong giỏ hàng!'], 422);
        }
    }

    public function getList(Request $request)
    {
        return $this->view('app.cart.list');
    }

    public function destroy(Request $request)
    {
        if ($request->session()->has(SS_CART)) {
            $request->session()->forget(SS_CART);
        }
        return response()->json([
            'message' => 'Hủy giỏ hàng thành công!',
        ], 200);
    }

    public function update(InsertCartRequest $request)
    {
        $cart = $request->session()->get(SS_CART, null);
        if ($cart == null) {
            return response()->json(['errors' => 'Chưa tồn tại giỏ hàng!'], 422);
        }
        if ($cart->get($request->input('id')) == null) {
            return response()->json(['errors' => 'Chưa có sản phẩm này trong giỏ hàng!'], 422);
        }
        if ($request->input('new_quatity') < 0) {
            return $this->remove($request);
        }
        $cart->get($request->input('id'))->setQuatity($request->input('new_quatity'));
        $request->session()->put(SS_CART, $cart);
        return response()->json([
            'length' => $cart->sum('quatity'),
            'message' => 'Cập nhật số lượng thành công!',
            'price' => number_format($cart->get($request->input('id'))->getAmount()),
            'sum' => number_format($cart->sum('amount')),
        ], 200);
    }
}
