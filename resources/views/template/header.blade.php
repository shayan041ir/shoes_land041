
<!-- Header -->
<header class="header">
<p>لوگوی فروشگاه</p>
<nav class="main-menu">
    <ul>
        <a href="{{ route('about') }}">درباره ما</a>
        <a href="{{ route('contact') }}">تماس با ما</a>
        <li><a href="#products">محصولات</a></li>
    </ul>
</nav>
<div class="user-menu">
    @if (Auth::guard('admin')->check())
        <li><a href="{{ route('admindashboard') }}">ادمین داشبورد</a></li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @elseif (Auth::guard('web')->check())
        <a href="#cart">سبد خرید</a>
        <li><a href="{{ route('user.dashboard') }}">داشبورد کاربر</a></li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <li><a href="{{ route('login') }}">ورود</a></li>
        <li><a href="{{ route('singup') }}">ثبت‌نام</a></li>
    @endif
</div>
</header>
