    
    <div class="add-admin">
        <h2>مدیریت اسلایدر</h2>

        <form action="{{ route('admin.slider.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="image">انتخاب تصویر:</label>
                <input type="file" name="image" id="image" required>
            </div>
            <div>
                <label for="product_id">لینک به محصول (اختیاری):</label>
                <select name="product_id" id="product_id">
                    <option value="">بدون لینک</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">آپلود اسلاید</button>
        </form>

        <h3>اسلایدهای فعلی:</h3>
        <div>
            @foreach ($sliders as $slider)
                <div>
                    <img src="{{ asset('storage/' . $slider->image_path) }}" alt="اسلاید"
                        style="width: 100px; height: auto;">
                    @if ($slider->product)
                        <p>محصول مرتبط: {{ $slider->product->name }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>