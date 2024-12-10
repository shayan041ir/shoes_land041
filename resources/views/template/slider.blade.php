<div class="slider">
    @foreach ($sliders as $slider)
        <div class="slide">
            <a href="{{ $slider->product ? route('product.show', $slider->product->id) : '#' }}">
                <img src="{{ asset('storage/' . $slider->image_path) }}" alt="اسلاید">
            </a>
        </div>
    @endforeach
</div>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif