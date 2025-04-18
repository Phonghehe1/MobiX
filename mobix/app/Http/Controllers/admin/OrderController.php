<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
    
        $newStatus = $request->input('status');
    
        // Nếu đơn hàng hiện tại đã hoàn thành thì không cho thay đổi bất kỳ trạng thái nào khác
        if ($order->status == 'completed' && $newStatus !== 'completed') {
            return redirect()->back()->with('error', 'Đơn hàng đã hoàn thành, không thể thay đổi trạng thái!');
        }
    
        // Nếu chuyển từ bất kỳ trạng thái nào sang "cancelled" mà đơn đã hoàn thành thì cấm
        if ($order->status == 'completed' && $newStatus == 'cancelled') {
            return redirect()->back()->with('error', 'Đơn hàng đã hoàn thành, không thể hủy!');
        }
    
        $order->update([
            'status' => $newStatus,
        ]);
    
        return redirect()->route('admin.orders.index')->with('message', 'Cập nhật trạng thái thành công');
    }
    
    


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('message', 'Xóa đơn hàng thành công');
    }
}
