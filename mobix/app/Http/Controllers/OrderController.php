<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán!');
    }

    $user = Auth::user();

    // ✅ Kiểm tra nếu thiếu SĐT hoặc địa chỉ thì yêu cầu cập nhật
    if (empty($user->phone) || empty($user->address)) {
        return redirect()->route('account.edit')->with('error', 'Vui lòng cập nhật số điện thoại và địa chỉ trước khi đặt hàng.');
    }

    $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.show')->with('error', 'Giỏ hàng trống!');
    }

    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return view('order.checkout', compact('cartItems', 'total'));
}


    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đặt hàng!');
        }
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Giỏ hàng trống!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method, // thêm dòng này
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('home')->with('success', 'Đặt hàng thành công!');
    }
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->get();
        return view('order.index', compact('orders'));
    }
}
