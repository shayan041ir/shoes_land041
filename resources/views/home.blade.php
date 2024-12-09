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

    @php
        $categories = \App\Models\Category::all();
        $products = \App\Models\Product::all();
    @endphp

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
            <a href="#cart">سبد خرید</a>
            @if (Auth::guard('admin')->check())
                <li><a href="{{ route('admindashboard') }}">ادمین داشبورد</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @elseif (Auth::guard('web')->check())
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
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button id="filter-button">اعمال فیلتر</button>
    </div>

    <!-- Products -->
    <div id="products" class="products-grid">
        @foreach ($products as $product)
            <div class="product">
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" style="height: 40px; width: 40px;">
                <p>{{ $product->name }}</p>
                <p>برند: {{ $product->brand }}</p>
                <p>قیمت: {{ $product->price }} تومان</p>
            </div>
        @endforeach
    </div>

    <!-- AJAX Script -->
    <script>
        
        $(document).ready(function () {
            function fetchProducts(filterCategory, searchQuery) {
                $.ajax({
                    url: "{{ route('home.products.filter') }}",
                    type: "GET",
                    data: {
                        category: filterCategory,
                        search: searchQuery
                    },
                    success: function (response) {
                        $('#products').html('');
                        response.products.forEach(product => {
                            $('#products').append(`
                                <div class="product">
                                    <img src="/storage/${product.image}" alt="${product.name}" style="height: 40px; width: 40px;">
                                    <p>${product.name}</p>
                                    <p>برند: ${product.brand}</p>
                                    <p>قیمت: ${product.price} تومان</p>
                                </div>
                            `);
                        });
                    },
                    error: function () {
                        alert('مشکلی در واکشی داده‌ها رخ داده است!');
                    }
                });
            }

            $('#search-button').on('click', function () {
                const searchQuery = $('#search-input').val();
                const filterCategory = $('#filter-category').val();
                fetchProducts(filterCategory, searchQuery);
            });

            $('#filter-button').on('click', function () {
                const searchQuery = $('#search-input').val();
                const filterCategory = $('#filter-category').val();
                fetchProducts(filterCategory, searchQuery);
            });
        });
    </script>
    
    <!-- Footer -->
    <footer class="footer">
        <p>© 2024 فروشگاه آنلاین. تمامی حقوق محفوظ است.</p>
        <p>تماس با ما: example@example.com</p>
    </footer>

    {{-- <script src="{{ asset('assets/js/scripts.js') }}"></script> --}}
</body>

</html>
