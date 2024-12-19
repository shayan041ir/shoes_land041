
<br>
<div class="add-admin">

    <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr>
                <th>نام کاربر</th>
                <th>تاریخ سفارش</th>
                <th>نام محصولات</th>
                <th>تعداد کل</th>
                <th>قیمت کلی</th>
                <th>وضعیت</th>
                <th>نام فروشنده</th>
            </tr>
        </thead>
        <tbody>
            <div class="total-sales">
                <h3>قیمت کلی تمامی فروش‌ها: {{ number_format($totalSales) }} تومان</h3>
            </div>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->user_name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->product_name ?? 'محصول حذف شده' }}</td>
                    <td>({{ $order->product_quantity }})</td>
                    <td>{{ number_format($order->total_price) }} تومان</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->seller_name }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
