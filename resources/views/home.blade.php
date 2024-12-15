<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه آنلاین</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'IRANSans', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        a {
            text-decoration: none;
        }

        /* Header */
        .header {
            background-color: #FF6F61;
            color: #fff;
            padding: 10px 20px;
        }

        .header .main-menu a {
            color: #fff;
            margin: 0 15px;
            font-weight: bold;
        }

        .header .user-menu button {
            background-color: transparent;
            border: 1px solid #fff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Slider */
        #home-slider {
            height: 500px;
            /* تنظیم ارتفاع دلخواه */
            width: 100%;
            /* تنظیم عرض به اندازه عرض صفحه */
            max-width: 1200px;
            /* تنظیم حداکثر عرض */
            margin: 0 auto;
            /* مرکز کردن اسلایدر */
        }

        .carousel-inner {
            height: 100%;
            /* تنظیم ارتفاع به 100% برای تصویر */
        }

        .carousel-item img {
            height: 100%;
            object-fit: cover;
            /* تصویر را به گونه‌ای مقیاس بندی می‌کند که فضای موجود را پر کند */
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 15px;
            border-radius: 8px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

        /* Search & Filter */
        .search-bar,
        .filter-bar {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .search-bar input,
        .filter-bar select {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 300px;
        }

        .search-bar button,
        .filter-bar button {
            background-color: #4A90E2;
            color: #fff;
            border: none;
            padding: 8px 15px;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px;
        }

        .product {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .product img {
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        /* Footer */
        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 10px;
            text-align: center;
        }

        .footer p {
            margin: 0;
        }

        .footer a {
            color: #FFD700;
            font-weight: bold;
        }
    </style>
</head>

<body>

    @php
        $categories = \App\Models\Category::all();
        $products = \App\Models\Product::all();
        $sliders = \App\Models\Slider::all();
    @endphp


    @include('template.header')

    <!-- Slider -->
    @include('template.slider')
    
    <!-- hero-section -->
    @include('template.hero-section')

    {{-- body --}}
    @include('template.body');

    <!-- Footer -->
    @include('template.footer');
</body>

</html>
