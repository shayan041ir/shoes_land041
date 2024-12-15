<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('assets/css/about-contact.css') }}">
</head>

<body>
    <div class="container">
        <header>
            <h1>About Us</h1>
            <button class="back-button" onclick="location.href='{{ route('home') }}';">Back to Home</button>
        </header>

        <main>
            <section>
                <h2>تاریخچه ما</h2>
                <p>شرکت ما در سال ۱۳۹۰ با هدف ارائه خدمات نوآورانه و تحول در صنعت تأسیس شد. از آن زمان تاکنون، توانسته‌ایم با جلب اعتماد مشتریان، به یکی از پیشروترین شرکت‌های صنعت خود تبدیل شویم.</p>
            </section>
            
            <section>
                <h2>ماموریت و چشم‌انداز</h2>
                <p>ماموریت ما ارائه راهکارهای هوشمند و خلاقانه‌ای است که به رشد و موفقیت کسب‌وکارها و افراد کمک کند. چشم‌انداز ما ایجاد دنیایی است که در آن فناوری و نوآوری محدودیت‌ها را از بین می‌برند.</p>
            </section>
            
            <section>
                <h2>تیم ما</h2>
                <div class="team">
                    <div class="team-member">
                        <img src="{{ asset('assets/images/team-member/avatar_5941668.png') }}" alt="محمد احمدی" style="width: 100px; height: 100px;">
                        <h3>محمد احمدی</h3>
                        <p>مدیرعامل و بنیان‌گذار</p>
                    </div>
                    <div class="team-member">
                        <img src="{{ asset('assets/images/team-member/businesswomen_5941674.png') }}" alt="سارا رضایی" style="width: 100px; height: 100px;">
                        <h3>سارا رضایی</h3>
                        <p>مدیر بازاریابی</p>
                    </div>
                </div>
            </section>
            
            <section>
                <h2>افتخارات ما</h2>
                <p>ما افتخار می‌کنیم که در سال ۱۴۰۰ به عنوان برترین استارتاپ انتخاب شدیم و بیش از ۱۰۰ پروژه موفق را به بهره‌برداری رسانده‌ایم که تأثیر مثبت چشمگیری در زندگی میلیون‌ها نفر داشته است.</p>
            </section>
            
            <footer>
                <p>Follow us:</p>
                <a href="https://facebook.com" target="_blank">Facebook</a> |
                <a href="https://twitter.com" target="_blank">Twitter</a> |
                <a href="https://instagram.com" target="_blank">Instagram</a>
            </footer>
        </main>
    </div>
</body>

</html>
