@php
    $userId = auth()->id(); // گرفتن آیدی کاربر وارد شده
    $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
        ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'orders.*',
            'users.name as user_name',
            'products.name as product_name',
            'order_items.quantity as product_quantity',
            'order_items.price as product_price', // اضافه کردن قیمت هر محصول
        )
        ->where('orders.user_id', $userId) // فیلتر سفارش‌ها فقط برای کاربر وارد شده
        ->get();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            direction: rtl;
            text-align: right;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .card {
            border-radius: 10px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table img {
            border-radius: 5px;
        }

        .btn {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">داشبورد کاربر</a>
            <button class="btn btn-outline-light" onclick="location.href='{{ route('home') }}';">بازگشت به خانه</button>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- سبد خرید -->
        <div class="card mb-5 shadow-sm">
            <div class="card-header  text-black">
                <h4 class="mb-0">سبد خرید شما</h4>
            </div>
            <div class="card-body">
                @if (session('cart') && count(session('cart')) > 0)
                    <div class="table-responsive">
                        <table class="table align-middle text-center">
                            <thead>
                                <tr>
                                    <th>تصویر</th>
                                    <th>نام محصول</th>
                                    <th>تعداد</th>
                                    <th>قیمت</th>
                                    <th>مجموع</th>
                                    <th>حذف</th>
                                    <th>پرداخت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session('cart') as $id => $item)
                                    <tr>
                                        <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="50"></td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>{{ number_format($item['price']) }} تومان</td>
                                        <td>{{ number_format($item['quantity'] * $item['price']) }} تومان</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('checkout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">پرداخت</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning text-center mb-0">سبد خرید شما خالی است.</div>
                @endif
            </div>
        </div>

        <!-- ویرایش اطلاعات -->
        <div class="card mb-5 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">ویرایش اطلاعات کاربری</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">نام کاربری:</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
                        <div class="invalid-feedback">لطفاً نام کاربری را وارد کنید.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل:</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
                        <div class="invalid-feedback">لطفاً ایمیل معتبر وارد کنید.</div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">آدرس:</label>
                        <input type="text" id="address" name="address" value="{{ auth()->user()->address }}" class="form-control" required>
                        <div class="invalid-feedback">لطفاً آدرس را وارد کنید.</div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">شماره تلفن (اختیاری):</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="شماره تلفن خود را وارد کنید" value="{{ old('phone', Auth::user()->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">رمز عبور جدید:</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">تأیید رمز عبور:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">ویرایش</button>
                </form>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <hr>
        <h3 class="mt-4">سفارش‌های من</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>تاریخ سفارش</th>
                        <th>نام محصولات</th>
                        <th>تعداد کل</th>
                        <th>قیمت کلی</th>
                        <th>وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->product_name ?? 'محصول حذف شده' }}</td>
                            <td>{{ $order->product_quantity }}</td>
                            <td>{{ number_format($order->product_price * $order->product_quantity) }} تومان</td>
                            <td class="order-status" data-order-id="{{ $order->id }}">ارسال شده</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const statusCells = document.querySelectorAll('.order-status');
            statusCells.forEach(cell => {
                setTimeout(() => {
                    cell.textContent = 'تحویل داده شد';
                }, 5000);
            });
        });
    </script>
</body>

</html>
