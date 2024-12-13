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
        @forelse ($products as $product)
            <a href="{{ route('product.show', ['id' => $product->id]) }}">
                <div class="product">
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                        style="height: 100px; width: 100px;">
                    <p>{{ $product->name }}</p>
                    <p>برند: {{ $product->brand }}</p>
                    <p>قیمت: {{ number_format($product->price) }} تومان</p>
                </div>
            </a>
        @empty
            <p>هیچ محصولی یافت نشد.</p>
        @endforelse
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
                    beforeSend: function() {
                        $('#products').html('<p>در حال بارگذاری...</p>');
                    },
                    success: function(response) {
                        $('#products').html('');
                        if (response.products.length > 0) {
                            response.products.forEach(product => {
                                $('#products').append(`
                            <a href="/product/show/${product.id}">
                                <div class="product">
                                    <img src="/storage/${product.image}" alt="${product.name}" style="height: 100px; width: 100px;">
                                    <p>${product.name}</p>
                                    <p>برند: ${product.brand}</p>
                                    <p>قیمت: ${product.price.toLocaleString()} تومان</p>
                                </div>
                            </a>
                        `);
                            });
                        } else {
                            $('#products').html('<p>هیچ محصولی یافت نشد.</p>');
                        }
                    },
                    error: function() {
                        alert('مشکلی در واکشی داده‌ها رخ داده است!');
                    }
                });
            }

            // بارگذاری محصولات پیش‌فرض در لود اولیه صفحه
            fetchProducts();

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

            // اجرای جستجو هنگام تایپ کردن در کادر جستجو (اختیاری)
            $('#search-input').on('input', function() {
                const searchQuery = $(this).val();
                const filterCategory = $('#filter-category').val();
                fetchProducts(filterCategory, searchQuery);
            });
        });
    </script>

    <!-- Style for Better UI -->
    <style>
        .search-bar,
        .filter-bar {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.2s;
        }

        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .product img {
            border-radius: 8px;
            margin-bottom: 10px;
        }
    </style>
