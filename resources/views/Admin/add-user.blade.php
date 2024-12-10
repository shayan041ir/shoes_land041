<div class="add-admin">
    <h1>add user</h1>
    @if (session('s'))
        <h6>{{ session('s') }}</h6>
    @endif

    <form action="{{ route('admin.adduser') }}" method="post">
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
    <table>
        <thead>
            <tr>
                <th>شناسه</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('user.delete', $user->id) }}" method="POST" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید {{ $user->name }} را حذف کنید؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">حذف کاربر</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <script>
        function confirmDelete(userName) {
            return confirm(`آیا مطمئن هستید که می‌خواهید کاربر ${userName} را حذف کنید؟`);
        }
    </script>    
</div>