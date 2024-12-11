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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>سبد خرید شما خالی است.</p>
            @endif
        </div>

</body>

</html>
