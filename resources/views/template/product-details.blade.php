<style>
    body {
        font-family: 'Vazir', sans-serif;
        background-color: #f8f9fa;
        color: #333;
    }

    .container {
        max-width: 900px;
        margin: auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #4a90e2;
    }

    .image-container {
        width: 300px;
        height: 300px;
        overflow: hidden;
        margin: auto;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.2s ease-in-out;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    .border {
        border: 1px solid #e1e1e1;
    }

    .rounded {
        border-radius: 8px;
    }

    .shadow,
    .shadow-sm {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .mt-4,
    .my-4 {
        margin-top: 1.5rem !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    .text-primary {
        color: #007bff !important;
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
</style>
<div class="container mt-4">
    <button class="btn btn-outline-secondary mb-4" onclick="location.href='{{ route('home') }}';">بازگشت به صفحه
        اصلی</button>

    <div class="row">
        <div class="col-md-6">
            <div class="image-container">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="img-fluid product-image">
            </div>
        </div>
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h3 class="text-primary">قیمت: {{ number_format($product->price) }} تومان</h3>
            <p>موجودی: <strong>{{ $product->stock }}</strong> عدد</p>

            @if (Auth::check())
                <!-- فرم افزودن به سبد خرید -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">تعداد:</label>
                        <div class="input-group">
                            <button type="button" class="btn btn-secondary" onclick="decreaseQuantity()">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                max="{{ $product->stock }}" class="form-control text-center">
                            <button type="button" class="btn btn-secondary" onclick="increaseQuantity()">+</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">افزودن به سبد خرید</button>
                </form>
            @else
                <!-- پیام برای کاربران غیر وارد شده -->
                <p class="text-danger">برای خرید این محصول ابتدا وارد حساب کاربری خود شوید یا ثبت نام کنید.</p>
                <a href="{{ route('login') }}" class="btn btn-success">ورود</a>
                <a href="{{ route('singup') }}" class="btn btn-info">ثبت نام</a>
            @endif
        </div>
    </div>

    <hr class="my-4">

    <!-- بخش نظرات -->
    <h3>نظرات</h3>
    <div class="mb-4">
        @if (Auth::check())
            <!-- فرم ثبت نظر -->
            <form action="{{ route('comments.store', $product->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">ثبت نظر:</label>
                    <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="نظر خود را وارد کنید"></textarea>
                </div>
                <button type="submit" class="btn btn-success">ارسال نظر</button>
            </form>
        @else
            <!-- پیام برای کاربران غیر وارد شده -->
            <p class="text-danger">برای ثبت نظر ابتدا وارد حساب کاربری خود شوید یا ثبت نام کنید.</p>
            <a href="{{ route('login') }}" class="btn btn-success">ورود</a>
            <a href="{{ route('singup') }}" class="btn btn-info">ثبت نام</a>
        @endif
    </div>
    <div>
        @forelse ($product->comments->where('is_approved', true) as $comment)
            <div class="border p-3 mb-2 rounded shadow-sm">
                <strong>{{ $comment->user->name }}</strong> گفت:
                <p>{{ $comment->content }}</p>
                <small class="text-muted">در {{ $comment->created_at->format('Y-m-d H:i') }}</small>
            </div>
        @empty
            <p>نظری برای این محصول ثبت نشده است.</p>
        @endforelse
    </div>
</div>

<script>
    function decreaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value--;
        }
    }

    function increaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) < {{ $product->stock }}) {
            quantityInput.value++;
        }
    }
</script>
