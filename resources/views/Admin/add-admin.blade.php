<div class="add-admin">
    <h1>add admin</h1>
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
        <input type="text" name="name" placeholder="name">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="submit" value="add admin">
    </form>


    <h1>delete user</h1>
    <table class="table">
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
                        @if (auth()->id() !== $admin->id) <!-- جلوگیری از حذف ادمین جاری -->
                            <form action="{{ route('admin.delete', $admin->id) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید ادمین {{ $admin->name }} را حذف کنید؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف ادمین</button>
                            </form>
                        @else
                            <span class="text-muted">شما نمی‌توانید خودتان را حذف کنید</span>
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