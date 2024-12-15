<h1>مدیریت برندها</h1>
<table class="table">
    <thead>
        <tr>
            <th>شناسه</th>
            <th>نام برند</th>
            <th>لوگو</th>
            <th>عملیات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($brands as $brand)
            <tr>
                <td>{{ $brand->id }}</td>
                <td>{{ $brand->name }}</td>
                <td>
                    @if ($brand->logo)
                        <img src="{{ Storage::url($brand->logo) }}" alt="Logo" width="50">
                    @endif
                </td>
                <td>
                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- فرم افزودن برند جدید -->
<h1>افزودن برند جدید</h1>
<form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">نام برند</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="نام برند را وارد کنید">
    </div>

    <div class="mb-3">
        <label for="logo" class="form-label">لوگو</label>
        <input type="file" id="logo" name="logo" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">افزودن</button>
</form>

<!-- فرم ویرایش برند -->
@if (isset($brand))
    <h1>ویرایش برند</h1>
    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">نام برند</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $brand->name }}">
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">لوگو</label>
            <input type="file" id="logo" name="logo" class="form-control">
            @if ($brand->logo)
                <img src="{{ Storage::url($brand->logo) }}" alt="Logo" width="100" class="mt-3">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">ویرایش</button>
    </form>
@endif
