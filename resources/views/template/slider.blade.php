<section id="hero-section" class="mb-5">
    <div id="hero-section" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"
        style="height: 500px; width: 100%; max-width: 1500px; margin: 0 auto;">
        <div class="carousel-inner">
            @foreach ($sliders as $index => $slider)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($slider->image_path) }}" class="d-block w-100" alt="Slider Image"
                        style="height: 500px; object-fit: contain;">
                    @if ($slider->product)
                        <div class="carousel-caption d-none d-md-block">
                            <h5>نام محصول: {{ $slider->product->name }}</h5>
                            <a href="{{ route('product.show', $slider->product->id) }}" class="btn btn-primary">مشاهده
                                محصول</a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- دکمه‌های هدایت -->
        {{-- <button class="carousel-control-prev" type="button" data-bs-target="#home-slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">قبلی</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#home-slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">بعدی</span>
        </button>
    </div> --}}

</section>

<div class="container position-relative">
    <div class="swiper-slide">
        <div class="row d-flex align-items-center justify-content-center">
            <!-- جزئیات محصول -->
            <div class="slider-details col-12 col-md-12 col-lg-7 text-center position-relative">
                <!-- لوگو -->
                <img src="{{ asset('assets/images/logo/shoes-land-high-resolution-logo-transparent.svg') }}"
                    alt="Shoes Land Logo" class="logo-img-large position-absolute top-50 start-50 translate-middle">
                <!-- متن -->
                <h3 class="title-main text-orange position-relative">
                    کفش‌های متنوع <strong class="name text-dark">شووز لند</strong>
                </h3>
                <h4 class="sub-title text-secondary mb-3 position-relative">
                    با برندهای دوست داشتنی دنیا و رنگ‌های بسیار متنوع برای شما عزیزان
                </h4>
                <p class="desc-product text-dark position-relative">
                    در فروشگاه "شووز لند"، ما مجموعه‌ای از بهترین کفش‌های ورزشی و مجلسی را برای شما عزیزان فراهم
                    کرده‌ایم.
                    کفش‌های ما با کیفیت بالا و طراحی مدرن، مناسب برای هر سلیقه و سبک زندگی هستند. با بیش از ۱۰ رنگ و مدل
                    متفاوت،
                    شما می‌توانید بهترین انتخاب را برای خود داشته باشید. از کفش‌های راحتی روزانه تا کفش‌های ورزشی
                    حرفه‌ای،
                    همه در "شووز لند" موجود است.
                </p>
            </div>
        </div>
    </div>
</div>



<style>
    :root {
        --orange-primary: #ff7f3f;
        --orange-light: #ffad69;
        --orange-dark: #e65c00;
        --text-dark: #333333;
        --text-muted: #666666;
    }

    /* متن با رنگ نارنجی */
    .text-orange {
        color: var(--orange-primary) !important;
    }

    /* استایل لوگو */
    .logo-img-large {
        width: 300px;
        /* تنظیم عرض لوگو */
        height: auto;
        /* حفظ تناسب لوگو */
        opacity: 0.5;
        /* شفافیت برای ایجاد جلوه مناسب */
        z-index: 1;
        /* قرار گرفتن لوگو در لایه پایین‌تر */
        pointer-events: none;
        /* جلوگیری از کلیک روی لوگو */
    }

    /* متن و توضیحات بالای لوگو */
    .title-main,
    .sub-title,
    .desc-product {
        z-index: 2;
        /* متن در لایه بالاتر از لوگو */
        position: relative;
        /* موقعیت‌دهی نسبی برای قرارگیری صحیح */
    }
</style>
