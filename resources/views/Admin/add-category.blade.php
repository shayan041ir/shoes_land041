{{-- <div class="categories" style="background-color: gray">
    <h1>Categories</h1>

    @if ($categories->isEmpty())
        <p>No categories available.</p>
    @else
        <ul>
            @foreach ($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    @endif
</div> --}}


<div class="add-category" style="background-color: gray">
    @php
        $categories = \App\Models\Category::all();
    @endphp

    @if ($categories->isEmpty())
        <p>No categories available.</p>
    @endif

    <h1>Add New Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Category Name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>

        <button type="submit"  style="background-color: green; color: white; padding: 10px 20px;">Add Category</button>
    </form>


    <h1>لیست دسته‌بندی‌ها</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>نام دسته‌بندی</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <form action="{{ route('category.delete', $category->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="background-color: red; color: white; padding: 5px 10px;">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
