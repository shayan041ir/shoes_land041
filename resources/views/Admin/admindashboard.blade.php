<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin dashboard</title>
    <style>
        .add-admin {
            background-color: grey;
        }
    </style>
</head>

<body>
    <h1>Admin Dashboard</h1>
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
    </div>
</body>

</html>
