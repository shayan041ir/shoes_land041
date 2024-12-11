@php
    $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.*', 'users.name as user_name')
        ->get();
@endphp
<br>
<div class="add-admin">
    <table class="table">
        <thead>
            <tr>
                <th>نام کاربر</th>
                <th>تاریخ سفارش</th>
                <th>قیمت کلی</th>
                <th>وضعیت</th>
                <th>نام فروشنده</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->user_name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>{{ number_format($order->total_price) }} تومان</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->seller_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
