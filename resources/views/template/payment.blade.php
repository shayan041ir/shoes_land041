<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت آنلاین</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            background-color: #f5f5f5;
            direction: rtl;
            text-align: center;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
            text-align: right;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function handleSubmit(event) {
            event.preventDefault(); // جلوگیری از ارسال فرم بلافاصله
            alert("پرداخت با موفقیت انجام شد!"); // نمایش پیام
            event.target.submit(); // ارسال فرم پس از نمایش پیام
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>صفحه پرداخت</h1>
        <p>نام کاربر: <strong>{{ $userName }}</strong></p>
        <p>مجموع مبلغ: <strong>{{ number_format($total_price) }} تومان</strong></p>

        <form action="{{ route('payment.complete') }}" method="POST" onsubmit="handleSubmit(event)">
            @csrf
            <div class="form-group">
                <label for="card-number">شماره کارت:</label>
                <input type="text" id="card-number" name="card_number" required>
            </div>
            <div class="form-group">
                <label for="password">رمز اینترنتی:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="cvv2">شماره CVV2:</label>
                <input type="text" id="cvv2" name="cvv2" required>
            </div>
            <div class="form-group">
                <label for="expire-date">تاریخ انقضا:</label>
                <input type="text" id="expire-date" name="expire_date" placeholder="ماه/سال" required>
            </div>
            <div class="form-group">
                <input type="submit" value="پرداخت">
            </div>
        </form>
    </div>
</body>

</html>
