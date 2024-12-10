
<div class="categories" style="background-color: gray">
    <h1>Categories</h1>
    @php
        $categories = \App\Models\Category::all();
    @endphp
    @if ($categories->isEmpty())
        <p>No categories available.</p>
    @else
        <ul>
            @foreach ($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    @endif
</div>


<div class="add-category" style="background-color: gray">
    <h1>Add New Category</h1>

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

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Category Name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required><br><br>

        <button type="submit">Add Category</button>
    </form>
</div>
