<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درگاه پرداخت ملی</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function handleSubmit(event) {
            event.preventDefault(); // جلوگیری از ارسال فرم بلافاصله
            alert("پرداخت با موفقیت انجام شد!"); // نمایش پیام
            event.target.submit(); // ارسال فرم پس از نمایش پیام
        }
    </script>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
            direction: rtl;
            text-align: center;
            background-color: #f8f9fa;
        }

        .payment-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background-color: #fcff33bc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #cb561b;
        }

        .payment-header {
            color: #dc3545;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #35dc51;
            border-color: #35dc72;
        }

        .btn-primary:hover {
            background-color: #39c823;
            border-color: #21bd36;
        }

        .note {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="payment-container">
        <h1 class="payment-header">درگاه پرداخت ملی</h1>
        <p>نام کاربر: <strong>{{ $userName }}</strong></p>
        <p>مجموع مبلغ: <strong>{{ number_format($total_price) }} تومان</strong></p>


        <form action="{{ route('payment.complete') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="card-number" class="form-label">شماره کارت:</label>
                <input type="text" id="card-number" name="card_number" class="form-control"
                    placeholder="xxxx xxxx xxxx xxxx" maxlength="19" required>
                <small class="note">شماره کارت باید 16 رقم باشد.</small>
            </div>

            <div class="row">
                <div class="col-6 mb-3">
                    <label for="expire-month" class="form-label">ماه انقضا:</label>
                    <input type="text" id="expire-month" name="expire_month" class="form-control" maxlength="2"
                        placeholder="MM" required>
                </div>
                <div class="col-6 mb-3">
                    <label for="expire-year" class="form-label">سال انقضا:</label>
                    <input type="text" id="expire-year" name="expire_year" class="form-control" maxlength="2"
                        placeholder="YY" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="cvv2" class="form-label">کد CVV2:</label>
                <input type="text" id="cvv2" name="cvv2" class="form-control" maxlength="4"
                    placeholder="xxx" required>
                <small class="note">کد CVV2 معمولاً 3 یا 4 رقم است.</small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">رمز اینترنتی:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="رمز پویا"
                    required>
            </div>

            <button type="submit" class="btn btn-primary w-100">پرداخت</button>
        </form>

        <div class="mt-3">
            <small class="text-muted">پرداخت شما در محیطی امن انجام خواهد شد.</small>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('card-number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '').replace(/[^\d]/g, '');
            let formatted = value.match(/.{1,4}/g)?.join(' ') || '';
            e.target.value = formatted;
        });
    </script>

</body>

</html>
