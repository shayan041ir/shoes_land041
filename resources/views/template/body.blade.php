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
            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                <div class="product">
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                        style="height: 40px; width: 40px;">
                    <p>{{ $product->name }}</p>
                    <p>برند: {{ $product->brand }}</p>
                    <p>قیمت: {{ $product->price }} تومان</p>
                </div>
            </a>
        @endforeach
    </div>
    
    <!-- AJAX Script -->
    <script>
        $(document).ready(function() {
            function fetchProducts(filterCategory, searchQuery) {
                $.ajax({
                    url: "{{ route('home.products.filter') }}",
                    type: "GET",
                    data: {
                        category: filterCategory,
                        search: searchQuery
                    },
                    success: function(response) {
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
                    error: function() {
                        alert('مشکلی در واکشی داده‌ها رخ داده است!');
                    }
                });
            }

            $('#search-button').on('click', function() {
                const searchQuery = $('#search-input').val();
                const filterCategory = $('#filter-category').val();
                fetchProducts(filterCategory, searchQuery);
            });

            $('#filter-button').on('click', function() {
                const searchQuery = $('#search-input').val();
                const filterCategory = $('#filter-category').val();
                fetchProducts(filterCategory, searchQuery);
            });
        });
    </script>
