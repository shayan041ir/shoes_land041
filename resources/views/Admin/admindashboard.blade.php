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
    @php
        $products = \App\Models\Product::all();
        $sliders = \App\Models\Slider::all();
        $users = \App\Models\User::all();
        $admins = \App\Models\Admin::all();
    @endphp
    <h1>Admin Dashboard</h1>
    {{-- add-admin --}}
    @include('Admin.add-admin')

    {{-- add user --}}
    @include('Admin.add-user')

    {{-- M.slider --}}
    @include('Admin.add-slider')

    {{-- add-product --}}
    @include('Admin.add-product')

    {{-- factor --}}
    @include('Admin.admin-factor')
</body>

</html>
