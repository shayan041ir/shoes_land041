<!-- Hero Section -->
<section id="hero-section" class="mb-5">
    <div id="home-slider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slider Items -->
            <div class="carousel-inner">
                @foreach ($sliders as $index => $slider)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ Storage::url($slider->image_path) }}" class="d-block w-100" alt="Slider Image">
                        @if ($slider->product)
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $slider->product->name }}</h5>
                                {{-- <p>{{ $slider->product->description }}</p> --}}
                                <a href="{{ route('product.show', $slider->product->id) }}" class="btn btn-primary">مشاهده محصول</a>
                            </div>
                        @endif
                    </div>
                @endforeach
            <div class="carousel-item">
                <img src="{{ asset('assets/images/slider3.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1>تخفیف‌های استثنایی فقط تا پایان ماه</h1>
                    <p>همین حالا سفارش دهید!</p>
                    <a href="/products" class="btn btn-warning">اکنون خرید کنید</a>
                </div>
            </div>
        </div>
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#home-slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">قبلی</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#home-slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">بعدی</span>
        </button>0
    </div>
</section>
