<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
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

        // افزودن آیتم‌های سفارش به دیتابیس و به‌روزرسانی موجودی محصول
        foreach ($cart as $productId => $item) {
            // ذخیره آیتم سفارش
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // به‌روزرسانی موجودی محصول
            $product = Product::find($productId);
            if ($product) {
                $product->stock = max(0, $product->stock - $item['quantity']); // جلوگیری از موجودی منفی
                $product->save();
            }
        }

        // محاسبه مجموع مبلغ
        $total_price = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['quantity'] * $item['price']);
        }, 0);

        // ذخیره در سشن
        session(['total_price' => $total_price]);

        // خالی کردن سبد خرید
        session()->forget('cart');

        // هدایت به صفحه تایید خرید
        return redirect()->route('payment', $order->id);
    }
}
