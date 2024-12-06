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
    @endauth

</body>

</html>
