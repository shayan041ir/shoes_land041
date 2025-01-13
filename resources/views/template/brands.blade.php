<!-- Brands Section -->
<section id="brands-section" class="my-5">
    <div class="container text-center">
        <h2 class="mb-4">برندهایی که با آنها همکاری می‌کنیم</h2>
        <div class="brand-carousel d-flex align-items-center overflow-hidden">
            <div class="d-flex" style="animation: scrollBrands 10s linear infinite;">
                @foreach ($brands as $brand)
                    <div class="brand-logo">
                        <img src="{{ Storage::url($brand->logo) }}" alt="{{ $brand->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
    #brands-section {
        background-color: #ffffff;
        padding: 40px 0;
    }

    .brand-carousel {
        position: relative;
        height: 100px;
        overflow: hidden;
    }

    .brand-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 120px; /* عرض ثابت برای لوگوها */
        height: 80px; /* ارتفاع ثابت برای لوگوها */
        margin: 0 15px; /* فاصله بین لوگوها */
    }

    .brand-logo img {
        max-width: 100%; /* حفظ تناسب عرض لوگو */
        max-height: 100%; /* حفظ تناسب ارتفاع لوگو */
        object-fit: contain; /* جلوگیری از کشیدگی لوگو */
    }

    @keyframes scrollBrands {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-300%);
        }
    }
</style>
