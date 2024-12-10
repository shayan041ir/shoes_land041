<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin dashboard</title>
    <style>
        .add-admin {
            background-color: grey;
        }
    </style>
</head>

<body>
    @php
        $products = \App\Models\Product::all();
        $sliders = \App\Models\Slider::all();
    @endphp
    <h1>Admin Dashboard</h1>
    <div class="add-admin">
        <h1>add admin</h1>
        @if (session('s'))
            <h6>{{ session('s') }}</h6>
        @endif

        <form action="{{ route('admin.addadmin') }}" method="post">
            @csrf
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="text" name="name" placeholder="name">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="add admin">
        </form>
    </div>

    <div class="slider">
        <h2>مدیریت اسلایدر</h2>

        <form action="{{ route('admin.slider.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="image">انتخاب تصویر:</label>
                <input type="file" name="image" id="image" required>
            </div>
            <div>
                <label for="product_id">لینک به محصول (اختیاری):</label>
                <select name="product_id" id="product_id">
                    <option value="">بدون لینک</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">آپلود اسلاید</button>
        </form>

        <h3>اسلایدهای فعلی:</h3>
        <div>
            @foreach ($sliders as $slider)
                <div>
                    <img src="{{ asset('storage/' . $slider->image_path) }}" alt="اسلاید"
                        style="width: 100px; height: auto;">
                    @if ($slider->product)
                        <p>محصول مرتبط: {{ $slider->product->name }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    @include('Admin.add-product')

</body>

</html>
