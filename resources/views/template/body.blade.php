<section class="footer-info col-12">
    <div class="container">
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
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
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

    </div>
</section>

<!-- AJAX Script -->
<script>
    const productShowRoute = "{{ url('product/') }}";
    $(document).ready(function() {
        function fetchProducts(filterCategory = 'all', searchQuery = '') {
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
                    console.log(response); // برای بررسی داده‌های بازگشتی
                    $('#products').html('');
                    if (response.products && response.products.length > 0) {
                        response.products.forEach(product => {
                            $('#products').append(`
                            <a href="${productShowRoute}/${product.id}">
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
                error: function(xhr, status, error) {
                    console.error("Error: ", error);
                    console.log(xhr.responseText);
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

        // بارگذاری پیش‌فرض
        fetchProducts();
    });
</script>

<!-- Style for Better UI -->
<style>
    /* بهبود استایل‌های جستجو و فیلتر */
    .search-bar,
    .filter-bar {
        margin: 20px 0;
        display: flex;
        gap: 10px;
        justify-content: right;
        flex-wrap: wrap;
    }

    .search-bar input,
    .filter-bar select {
        width: 100%;
        max-width: 300px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .search-bar button,
    .filter-bar button {
        background-color: #4a90e2;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-bar button:hover,
    .filter-bar button:hover {
        background-color: #357ABD;
    }

    /* بهبود استایل‌های شبکه محصولات */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .product {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        background-color: #fff;
    }

    .product:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .product img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
        object-fit: cover;
    }

    a {
        color: inherit;
        /* یا یک رنگ مشخص برای لینک‌ها تعیین کنید */
        text-decoration: none;
    }

    /* برای تغییر رنگ لینک‌ها به یک رنگ خاص */
    a {
        color: #333;
        /* به عنوان مثال، رنگ مشکی */
        text-decoration: none;
    }

    a:hover {
        color: #007bff;
        /* رنگ لینک‌ها هنگام هاور */
        text-decoration: underline;
        /* می‌توانید این خط را هم حذف کنید */
    }

    .footer-info {
        padding: 40px 0;
        border-top: 1px solid var(--hover-color);
        border-bottom: 1px solid var(--hover-color);
    }

    /* مدیا کوئری‌ها برای ریسپانسیو کردن */
    @media (max-width: 768px) {

        .search-bar,
        .filter-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-bar button,
        .filter-bar button {
            width: 100%;
            margin-top: 10px;
        }
    }

    @media (max-width: 576px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
