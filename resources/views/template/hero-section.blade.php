<!-- Brands Section -->
<section id="brands-section" class="my-5">
    <div class="container text-center">
        <h2 class="mb-4">برندهایی که با آنها همکاری می‌کنیم</h2>
        <div class="brand-carousel d-flex align-items-center overflow-hidden">
            <div class="d-flex" style="animation: scrollBrands 10s linear infinite;">
                <img src="{{ asset('assets/images/brand1.png') }}" alt="Brand 1" class="mx-3" style="height: 80px;">
                <img src="{{ asset('assets/images/brand2.png') }}" alt="Brand 2" class="mx-3" style="height: 80px;">
                <img src="{{ asset('assets/images/brand3.png') }}" alt="Brand 3" class="mx-3" style="height: 80px;">
                <img src="{{ asset('assets/images/brand4.png') }}" alt="Brand 4" class="mx-3" style="height: 80px;">
                <img src="{{ asset('assets/images/brand5.png') }}" alt="Brand 5" class="mx-3" style="height: 80px;">
            </div>
        </div>
    </div>
</section>

<style>
    #brands-section {
        background-color: #f9f9f9;
        padding: 40px 0;
    }
    .brand-carousel {
        position: relative;
        height: 100px;
        overflow: hidden;
    }
    @keyframes scrollBrands {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-100%);
        }
    }
</style>