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
        {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="لوگوی فروشگاه"> --}}
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
        <form method="GET" action="{{ route('home.product') }}">
            <select id="filter-category" name="category">
                <option value="all" {{ $selectedCategory == 'all' ? 'selected' : '' }}>همه دسته‌ها</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}" {{ $selectedCategory == $category->name ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit">اعمال فیلتر</button>
        </form>    </div>


    <!-- Products -->
    <div id="products" class="products-grid">
        @foreach ($products as $product)
            <div class="product" data-category="{{ $product->category }}">
                <img src="{{ $product->image }}" alt="{{ $product->name }}">
                <p>{{ $product->name }}</p>
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const products = @json($products);

            function renderProducts(filter = "all") {
                const productsContainer = document.getElementById('products');
                productsContainer.innerHTML = '';
                const filteredProducts = products.filter(
                    (p) => filter === "all" || p.category === filter
                );
                filteredProducts.forEach((product) => {
                    const productDiv = document.createElement('div');
                    productDiv.classList.add('product');
                    productDiv.innerHTML = `
                        <img src="${product.image}" alt="${product.name}">
                        <p>${product.name}</p>
                    `;
                    productsContainer.appendChild(productDiv);
                });
            }

            renderProducts();

            document.getElementById('apply-filter').addEventListener('click', () => {
                const selectedCategory = document.getElementById('filter-category').value;
                renderProducts(selectedCategory);
            });

            document.getElementById('search-button').addEventListener('click', () => {
                const query = document.getElementById('search-input').value.toLowerCase();
                const productsContainer = document.getElementById('products');
                productsContainer.innerHTML = '';
                products
                    .filter((p) => p.name.toLowerCase().includes(query))
                    .forEach((product) => {
                        const productDiv = document.createElement('div');
                        productDiv.classList.add('product');
                        productDiv.innerHTML = `
                            <img src="${product.image}" alt="${product.name}">
                            <p>${product.name}</p>
                        `;
                        productsContainer.appendChild(productDiv);
                    });
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
