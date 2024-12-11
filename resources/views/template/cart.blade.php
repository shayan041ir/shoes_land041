    <div class="container">
        <h2>سبد خرید شما</h2>
        @if (session('cart') && count(session('cart')) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>نام محصول</th>
                        <th>تعداد</th>
                        <th>قیمت</th>
                        <th>مجموع</th>
                        <th>عملیات</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('cart') as $id => $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                    width="50">
                            </td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price']) }} تومان</td>
                            <td>{{ number_format($item['quantity'] * $item['price']) }} تومان</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                            <td>
                                @if (session('cart') && count(session('cart')) > 0)
                                    <div class="text-end">
                                        <form action="{{ route('checkout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">پرداخت</button>
                                        </form>
                                    </div>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>سبد خرید شما خالی است.</p>
        @endif
    </div>
