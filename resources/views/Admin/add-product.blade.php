{{-- add-category --}}
@include('Admin.add-category')


<div class="add product" style="background-color: gray">
    <h1>add product</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description">{{ old('description') }}</textarea><br><br>

        <label for="price">Price:</label><br>
        <input type="number" step="0.01" id="price" name="price" value="{{ old('price') }}" required><br><br>

        <label for="stock">Stock:</label><br>
        <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required><br><br>

        <label for="color">Color:</label><br>
        <input type="text" id="color" name="color" value="{{ old('color') }}"><br><br>

        <label for="material">Material:</label><br>
        <input type="text" id="material" name="material" value="{{ old('material') }}"><br><br>

        <label for="brand">Brand:</label><br>
        <input type="text" id="brand" name="brand" value="{{ old('brand') }}"><br><br>

        <label for="image">Product Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        @php
            $categories = \App\Models\Category::all();
        @endphp
        <label for="categories">Categories:</label><br>
        <select id="categories" name="categories[]" multiple>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Add Product</button>
    </form>


    <table class="table">
        <thead>
            <tr>
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
                        <form action="{{ route('product.delete', $product->id) }}" method="POST"
                            onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این محصول را حذف کنید؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
