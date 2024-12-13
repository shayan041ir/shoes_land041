<div class="container">
    <button onclick="location.href='{{ route('home') }}';">Back to Home</button>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h3>قیمت: {{ number_format($product->price) }} تومان</h3>
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
                <p class="text-danger">برای خرید این محصول ابتدا وارد حساب کاربری خود شویدیا ثبت نام بکنید.</p>
                <a href="{{ route('login') }}" class="btn btn-success">ورود</a>/
                <a href="{{ route('singup') }}">ثبت نام</a>
            @endif
        </div>
    </div>

    <hr>

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
            <p class="text-danger">برای خرید این محصول ابتدا وارد حساب کاربری خود شویدیا ثبت نام بکنید.</p>
            <a href="{{ route('login') }}" class="btn btn-success">ورود</a>/
            <a href="{{ route('singup') }}">ثبت نام</a>
        @endif
    </div>
    <div>
        @forelse ($product->comments->where('is_approved', true) as $comment)
            <div class="border p-3 mb-2">
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
