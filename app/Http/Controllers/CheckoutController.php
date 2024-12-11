<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // بررسی وجود محصولات در سبد خرید
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'سبد خرید شما خالی است.');
        }

        // ایجاد سفارش جدید
        $order = new Order([
            'user_id' => Auth::id(),
            'total_price' => array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['quantity'] * $item['price']);
            }, 0),
        ]); 
        $order->save();

        // افزودن آیتم‌های سفارش به دیتابیس
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // خالی کردن سبد خرید
        session()->forget('cart');

        // هدایت به صفحه تایید خرید
        return redirect()->route('order.success', $order->id);
    }
    public function success(Order $order)
    {
        return view('template.order-success', compact('order'));
    }
}
