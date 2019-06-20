<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function profileEdit()
    {
        $user = auth()->user();
        return view('pages.my-profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->with('error', '驗證發生錯誤');
        }

        $user = auth()->user();
        $input = $request->except('password', 'password_confirmation');

        if (! $request->filled('password')) {
            $user->fill($input)->save();
            return back()->with('success_message', '成功更新個人資料!');
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back()->with('success_message', '成功更新個人資料及密碼!');
    }
    
    public function orderIndex()
    {
        $user = auth()->user();
        $orders = $user->orders()->with('products')->get();
        return view('pages.my-order', compact('user', 'orders'));
    }
}
