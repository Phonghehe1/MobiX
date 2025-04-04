<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng!');
        }
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        return view('cart.show', compact('cartItems'));
    }

    public function add(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm vào giỏ hàng!');
    }

    $product = Product::findOrFail($request->product_id);

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $cartItem = Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->first();

    if ($cartItem) {
        // Nếu đã có, cập nhật số lượng
        $cartItem->quantity += $request->quantity ?? 1;
        $cartItem->save();
    } else {
        // Nếu chưa có, thêm mới vào giỏ hàng
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity ?? 1,
        ]);
    }

    return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
}


    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xóa sản phẩm khỏi giỏ hàng!');
        }
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->back()->with('success', 'Đã xóa khỏi giỏ hàng!');
    }
}
