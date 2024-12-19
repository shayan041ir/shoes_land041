<!-- Header -->
<header class="header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h5">Shoes Land</h1>
    </div>
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
            <li><a href="{{ route('cart.view') }}">سبد خرید</a></li>
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
