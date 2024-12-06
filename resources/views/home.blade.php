<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه آنلاین</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="nav">
        {{-- <h1>Home</h1>
        <p>Welcome to my home page</p>

        @if (session('message'))
            <div>{{ session('message') }}</div>
        @endif

        @if (session('error'))
            <div>{{ session('error') }}</div>
        @endif

        <li>
            <a href="{{ route('about') }}">About</a>
        </li>
        <li>
            <a href="{{ route('contact') }}">Contact</a>
        </li>

        <li>
            <a href="{{ route('admindashboard') }}">admindashboard</a>
        </li> --}}

        {{-- لینک‌های میهمان --}}
        {{-- @guest
            <li>
                <a href="{{ route('login') }}">Login</a>
            </li>
            <li>
                <a href="{{ route('singup') }}">Sign Up</a>
            </li>
        @endguest --}}

        {{-- لینک‌های کاربر واردشده --}}
        {{-- @auth
            <li>
                <a href="{{ route('dashboard') }}">Panel</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endauth --}}

    </div>


    <!-- Header -->
    <header class="header">
        {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="لوگوی فروشگاه"> --}}
        <p>لوگوی فروشگاه</p>
        <nav class="main-menu">
            <ul>
                <li><a href="#about">درباره ما</a></li>
                <li><a href="#contact">تماس با ما</a></li>
                <li><a href="#products">محصولات</a></li>
            </ul>
        </nav>
        <div class="user-menu">
            <a href="#cart">سبد خرید</a>
            <a href="#login">ورود / ثبت‌نام</a>
        </div>
    </header>

    <!-- Slider -->
    <div class="slider">
        <div class="slides">
            <img src="{{ asset('assets/images/slide1.jpg') }}" alt="اسلاید 1">
            <img src="{{ asset('assets/images/slide2.jpg') }}" alt="اسلاید 2">
            <img src="{{ asset('assets/images/slide3.jpg') }}" alt="اسلاید 3">
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="جستجوی محصول...">
        <button id="search-button">جستجو</button>
    </div>

    <!-- Filter -->
    <div class="filter-bar">
        <select id="filter-category">
            <option value="all">همه دسته‌ها</option>
            <option value="electronics">الکترونیک</option>
            <option value="fashion">مد</option>
            <option value="books">کتاب</option>
        </select>
        <button id="apply-filter">اعمال فیلتر</button>
    </div>

    <!-- Products -->
    <div id="products" class="products-grid">
        <!-- محصولات واکشی شده اینجا قرار می‌گیرند -->
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2024 فروشگاه آنلاین. تمامی حقوق محفوظ است.</p>
        <p>تماس با ما: example@example.com</p>
    </footer>

    <script src="{{ asset('assets/js/scripts.js') }}"></script>


</body>

</html>
