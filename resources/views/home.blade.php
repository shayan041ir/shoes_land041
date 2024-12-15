<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه آنلاین</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    @php
        $categories = \App\Models\Category::all();
        $products = \App\Models\Product::all();
        $sliders = \App\Models\Slider::all();
        $brands = \App\Models\Brand::all();
    @endphp

    {{-- header --}}
    @include('template.header')

    <!-- Slider -->
    @include('template.slider')

    {{-- body --}}
    @include('template.body')

    <!-- brands -->
    @include('template.brands')

    <!-- Footer -->
    @include('template.footer')
</body>

</html>
