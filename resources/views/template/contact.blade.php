<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('assets/css/about-contact.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    @include('template.header')

    <div class="container">
        <header>
            <h1>Contact Us</h1>
            <button class="back-button" onclick="location.href='{{ route('home') }}';">Back to Home</button>
        </header>

        <main>
            <section>
                <h2>با ما در ارتباط باشید</h2>
                <p>اگر سوالی دارید یا به مشاوره نیاز دارید، لطفاً با ما تماس بگیرید. تیم ما آماده پاسخگویی به شما در
                    روزهای کاری (شنبه تا پنج‌شنبه) از ساعت ۹ صبح تا ۶ عصر می‌باشد.</p>
            </section>

            <section>
                <h2>اطلاعات تماس</h2>
                <ul>
                    <li><strong>تلفن:</strong> +98 41 1234 5678</li>
                    <li><strong>ایمیل:</strong> support@shoesland.com</li>
                    <li><strong>آدرس:</strong> خیابان نوآوری، شماره ۱۲۳، تهران، ایران</li>
                </ul>
            </section>

            <section>
                <h2>پرسش‌های متداول</h2>
                <p><strong>س:</strong> چگونه می‌توانم درخواست مشاوره دهم؟<br><strong>پ:</strong> لطفاً فرم تماس را پر
                    کنید یا به آدرس email@yourcompany.com ایمیل بزنید.</p>
                <p><strong>س:</strong> ساعات کاری شما چگونه است؟<br><strong>پ:</strong> شنبه تا پنج‌شنبه، ساعت ۹ صبح تا
                    ۶ عصر.</p>
            </section>

            <section>
                <h2>موقعیت ما</h2>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2647.888152928845!2d46.2928113!3d38.0799671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDA0JzQ3LjkiTiA0NsKwMTcnMzMuMSJF!5e0!3m2!1sen!2s!4v1681234567890"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </section>
            <section>
                <form action="{{ route('contact') }}" method="post">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required></textarea><br>

                    <input type="submit" value="Submit" class="submit-button">
                </form>
            </section>
        </main>
    </div>

    @include('template.footer')

</body>

</html>
