
    <div class="container text-center">
        <h2>سفارش شما با موفقیت ثبت شد!</h2>
        <p>شماره سفارش: <strong>{{ $order->id }}</strong></p>
        <p>مجموع مبلغ: <strong>{{ number_format($order->total_price) }} تومان</strong></p>
        <a href="{{ route('home') }}" class="btn btn-primary">بازگشت به صفحه اصلی</a>
    </div>
