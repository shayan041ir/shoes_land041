{{-- add-category --}}
<style>
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2 {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-group textarea {
        resize: vertical;
    }

    .form-group input[type="file"] {
        padding: 0;
    }



    button:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th,
    table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    table th {
        background-color: #f4f4f4;
    }

    img {
        border-radius: 4px;
    }
</style>
@include('Admin.add-category')

<br>
<div class="container">
    <h1>افزودن محصول</h1>

    {{-- نمایش پیام موفقیت --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- نمایش خطاها --}}
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- فرم افزودن محصول --}}
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="name">نام محصول:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="description">توضیحات:</label><br>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="price">قیمت:</label><br>
            <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="stock">موجودی:</label><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="color">رنگ:</label><br>
            <input type="text" id="color" name="color" value="{{ old('color') }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="material">جنس:</label><br>
            <input type="text" id="material" name="material" value="{{ old('material') }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="brand">برند:</label><br>
            <input type="text" id="brand" name="brand" value="{{ old('brand') }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="image">تصویر محصول:</label><br>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div style="margin-bottom: 15px;">
            @php
                $categories = \App\Models\Category::all();
            @endphp
            <label for="categories">دسته‌بندی‌ها:</label><br>
            <select id="categories" name="categories[]" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="background-color: green; color: white; padding: 10px 20px;">افزودن
            محصول</button>
    </form>
</div>

<div class="container" style="margin-top: 30px;">
    <h2>لیست محصولات</h2>

    <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th>شناسه</th>
                <th>تصویر</th>
                <th>نام</th>
                <th>قیمت</th>
                <th>موجودی</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                width="50">
                        @else
                            <span>بدون تصویر</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price) }} تومان</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        {{-- فرم حذف محصول --}}
                        <form action="{{ route('product.delete', $product->id) }}" method="POST"
                            onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این محصول را حذف کنید؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="background-color: red; color: white; padding: 5px 10px;">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container" style="background-color: rgb(255, 255, 255); padding: 20px;">
    <h1>ویرایش محصول</h1>

    {{-- نمایش پیام موفقیت --}}
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    {{-- نمایش خطاها --}}
    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- فرم ویرایش محصول --}}
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="name">نام محصول:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="description">توضیحات:</label><br>
            <textarea id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="price">قیمت:</label><br>
            <input type="number" step="0.01" id="price" name="price"
                value="{{ old('price', $product->price) }}" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="stock">موجودی:</label><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="color">رنگ:</label><br>
            <input type="text" id="color" name="color" value="{{ old('color', $product->color) }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="material">جنس:</label><br>
            <input type="text" id="material" name="material" value="{{ old('material', $product->material) }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="brand">برند:</label><br>
            <input type="text" id="brand" name="brand" value="{{ old('brand', $product->brand) }}">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="image">تصویر جدید:</label><br>
            <input type="file" id="image" name="image" accept="image/*">
            <br>
            @if ($product->image)
                <p>تصویر فعلی:</p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
            @endif
        </div>

        <div style="margin-bottom: 15px;">
            <label for="categories">دسته‌بندی‌ها:</label><br>
            <select id="categories" name="categories[]" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" style="background-color: blue; color: white; padding: 10px 20px;">ذخیره
            تغییرات</button>
    </form>
</div>
