<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>
    <button onclick="location.href='{{ route('home') }}';">Back to Home</button>
    <div class="container">
        <h2>سبد خرید شما</h2>
        @if (session('cart') && count(session('cart')) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>نام محصول</th>
                        <th>تعداد</th>
                        <th>قیمت</th>
                        <th>مجموع</th>
                        <th>عملیات</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('cart') as $id => $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                    width="50">
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price']) }} تومان</td>
                            <td>{{ number_format($item['quantity'] * $item['price']) }} تومان</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                            <td>
                                @if (session('cart') && count(session('cart')) > 0)
                                    <div class="text-end">
                                        <form action="{{ route('checkout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">پرداخت</button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>سبد خرید شما خالی است.</p>
        @endif
    </div>

    <div class="container">
        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <ul style="color: red;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h2>ویرایش اطلاعات کاربری</h2>
        <form action="{{ route('user.update') }}" method="POST">
            @csrf
            @method('PUT')

            <label for="name">نام کاربری:</label>
            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required>
            <br>
            <label for="password">رمز عبور جدید:</label>
            <input type="password" id="password" name="password">
            <br>

            <label for="password_confirmation">تأیید رمز عبور:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
            <br>

            <button type="submit">ویرایش</button>
        </form>

    </div>


</body>

</html>
