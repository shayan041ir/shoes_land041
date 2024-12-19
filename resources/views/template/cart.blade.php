<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه آنلاین</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Vazir', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            color: #4a90e2;
            margin-bottom: 20px;
        }

        .table img {
            border-radius: 8px;
        }

        .btn-primary,
        .btn-danger,
        .btn-success {
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .text-end {
            text-align: end;
        }

        .btn-back {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    @include('template.header')
    <div class="container">
        <button class="btn btn-secondary btn-back" onclick="location.href='{{ route('home') }}';">بازگشت به
            خانه</button>
        <h2>سبد خرید شما</h2>

        @if (session('cart') && count(session('cart')) > 0)
            <table class="table table-bordered">
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
                                    width="50"></td>
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
                                <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">پرداخت</button>
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

    @include('template.footer')

</body>

</html>
