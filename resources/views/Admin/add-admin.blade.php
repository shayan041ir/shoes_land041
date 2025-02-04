<div class="add-admin">
    <h1>افزودن ادمین</h1>
    @if (session('s'))
        <h6>{{ session('s') }}</h6>
    @endif

    <form action="{{ route('admin.addadmin') }}" method="post">
        @csrf
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="text" name="name" placeholder="نام">
        <input type="email" name="email" placeholder="ایمیل">
        <input type="password" name="password" placeholder="رمز عبور">
        <button type="submit" class="btn btn-success">افزودن</button>

    </form>

    <h2>ویرایش اطلاعات ادمین</h2>
    <form action="{{ route('admin.update') }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" id="name" name="name" placeholder="نام" required>
        <input type="email" id="email" name="email" placeholder="ایمیل">
        <input type="password" id="password" name="password" placeholder="رمز عبور جدید">
        <input type="password" id="password_confirmation" name="password_confirmation"
            placeholder="تکرار رمز عبور جدید">
        <button type="submit" class="btn btn-success">ویرایش</button>

    </form>

    <h1>حذف ادمین</h1>
    <table class="table" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr>
                <th>شناسه</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        @if (auth()->id() !== $admin->id)
                            <!-- جلوگیری از حذف ادمین جاری -->
                            <form action="{{ route('admin.delete', $admin->id) }}" method="POST"
                                onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید ادمین {{ $admin->name }} را حذف کنید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    style="background-color: red; color: white; padding: 5px 10px;">حذف ادمین</button>
                            </form>
                        @else
                            <span class="text-muted" style="background-color: red; color: white; padding: 5px 10px;">شما
                                نمی‌توانید خودتان را حذف کنید</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function confirmDelete(userName) {
            return confirm(`آیا مطمئن هستید که می‌خواهید ادمین ${userName} را حذف کنید؟`);
        }
    </script>

</div>
