@php
    $product =  \App\Models\Product::findOrFail($id);
@endphp

@section('content')
    <div class="product-details">
        <h1>{{ $product->name }}</h1>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        <p>قیمت: {{ $product->price }} تومان</p>
        <p>{{ $product->description }}</p>
        {{-- <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">افزودن به سبد خرید</a> --}}
    </div>
@endsection
