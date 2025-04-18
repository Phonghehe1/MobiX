<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('account.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20', // ✅ Bắt buộc
        'address' => 'required|string|max:255', // ✅ Bắt buộc
        'password' => 'nullable|string|min:8|confirmed',
    ], [
        'name.required' => 'Vui lòng nhập họ tên.',
        'phone.required' => 'Vui lòng nhập số điện thoại.',
        'address.required' => 'Vui lòng nhập địa chỉ.',
        'name.max' => 'Họ tên không được vượt quá :max ký tự.',
        'phone.max' => 'Số điện thoại không được vượt quá :max ký tự.',
        'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',
        'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
    ]);


    $user->name = $validated['name'];
    $user->phone = $validated['phone'];
    $user->address = $validated['address'];

    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('account.edit')->with('message', 'Cập nhật thành công!');
}
}


