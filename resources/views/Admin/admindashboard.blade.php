@php
    $products = \App\Models\Product::all();
    $sliders = \App\Models\Slider::all();
    $users = \App\Models\User::all();
    $admins = \App\Models\Admin::all();
    $Comments = \App\Models\Comment::all();
    $brands = \App\Models\Brand::all();
    $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
        ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'orders.*',
            'users.name as user_name',
            'products.name as product_name',
            'order_items.quantity as product_quantity',
        )
        ->get();

    $totalSales = $orders->sum('total_price');
    // تعداد کاربران در ماه جاری
    $currentMonthUsers = \App\Models\User::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    // تعداد کاربران در ماه گذشته
    $lastMonthUsers = \App\Models\User::whereMonth('created_at', now()->subMonth()->month)
        ->whereYear('created_at', now()->subMonth()->year)
        ->count();

    // درصد رشد ماهانه
    $monthlyGrowth = $lastMonthUsers > 0 ? (($currentMonthUsers - $lastMonthUsers) / $lastMonthUsers) * 100 : 0;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>admin dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            transition: all 0.3s;
        }

        .sidebar.collapsed h2 {
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .sidebar ul li a:hover {
            color: #17a2b8;
            text-decoration: none;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            transition: margin 0.3s;
        }

        .sidebar.collapsed ul li a i {
            margin-right: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .main-content.collapsed {
            margin-left: 80px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h5 {
            font-size: 18px;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .toggle-btn {
            font-size: 20px;
            color: #343a40;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="sidebar" id="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="{{ route('admindashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#factor-tab"><i class="fas fa-chart-line"></i> Analytics</a></li>
            <li><a href="{{ route('home') }}"><i class="fas fa-sign-out-alt"></i> home page</a></li>
        </ul>
    </div>

    <div class="main-content" id="main-content">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <h4>Welcome, Admin</h4>
            </div>
        </nav>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5><i class="fas fa-users"></i> Total Users</h5>
                        <p class="mt-2">{{ $users->count() }}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5><i class="fas fa-shopping-cart"></i> Total Sales</h5>
                        <p class="mt-2">ـ {{ number_format($totalSales) }} تومان</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-3">
                        <h5><i class="fas fa-chart-line"></i> Monthly Growth</h5>
                        <p class="mt-2">{{ round($monthlyGrowth, 2) }}%</p>
                    </div>
                </div>
            </div>



            <div class="mt-4">
                <ul class="nav nav-tabs" id="bladeTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="add-admin-tab" data-bs-toggle="tab"
                            data-bs-target="#add-admin" type="button" role="tab" aria-controls="add-admin"
                            aria-selected="true">Add Admin</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="add-user-tab" data-bs-toggle="tab" data-bs-target="#add-user"
                            type="button" role="tab" aria-controls="add-user" aria-selected="false">Add
                            User</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="slider-tab" data-bs-toggle="tab" data-bs-target="#slider"
                            type="button" role="tab" aria-controls="slider" aria-selected="false">Slider</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="add-product-tab" data-bs-toggle="tab" data-bs-target="#add-product"
                            type="button" role="tab" aria-controls="add-product" aria-selected="false">Add
                            Product</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="brands-tab" data-bs-toggle="tab" data-bs-target="#brands"
                            type="button" role="tab" aria-controls="brands" aria-selected="false">Brands</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="comments-tab" data-bs-toggle="tab" data-bs-target="#comments"
                            type="button" role="tab" aria-controls="comments"
                            aria-selected="false">Comments</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="factor-tab" data-bs-toggle="tab" data-bs-target="#factor"
                            type="button" role="tab" aria-controls="factor"
                            aria-selected="false">Factor</button>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="bladeTabsContent">
                    <div class="tab-pane fade show active" id="add-admin" role="tabpanel"
                        aria-labelledby="add-admin-tab">
                        @include('Admin.add-admin')
                    </div>
                    <div class="tab-pane fade" id="add-user" role="tabpanel" aria-labelledby="add-user-tab">
                        @include('Admin.add-user')
                    </div>
                    <div class="tab-pane fade" id="slider" role="tabpanel" aria-labelledby="slider-tab">
                        @include('Admin.add-slider')
                    </div>
                    <div class="tab-pane fade" id="add-product" role="tabpanel" aria-labelledby="add-product-tab">
                        @include('Admin.add-product')
                    </div>
                    <div class="tab-pane fade" id="brands" role="tabpanel" aria-labelledby="comments-tab">
                        @include('Admin.adminBrands')
                    </div>
                    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
                        @include('Admin.comments')
                    </div>
                    <div class="tab-pane fade" id="factor" role="tabpanel" aria-labelledby="factor-tab">
                        @include('Admin.admin-factor')
                    </div>
                </div>
            </div>


        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        });
    </script>
</body>

</html>
