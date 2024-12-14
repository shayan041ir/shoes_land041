<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);

        $cart = session()->get('cart', []);

        // افزودن محصول به سبد خرید
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'محصول به سبد خرید اضافه شد!');
    }


    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('template.cart', compact('cart'));
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'محصول از سبد خرید حذف شد!');
    }


    public function payment(Order $order)
    {
        $userName = auth()->user()->name; // فرض بر این است که کاربر وارد شده است.
        return view('template.payment', compact('order','userName'));
    }

    public function completePayment(Request $request)
    {
        session()->forget('cart'); // پاک کردن سبد خرید پس از پرداخت
        session()->forget('total_price');

        return redirect()->route('home')->with('success', 'پرداخت با موفقیت انجام شد!');
    }
}
