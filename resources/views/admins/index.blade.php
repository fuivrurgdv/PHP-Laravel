
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .sidebar .user-info {
            margin-bottom: 20px;
        }
        .sidebar .user-info img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .sidebar .nav-item {
            margin: 10px 0;
        }
        .content {
            padding: 20px;
            flex-grow: 1;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: transparent;
            border-bottom: none;
        }
        .card-body {
            padding: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .search-bar input {
            border-radius: 20px;
            padding: 10px 20px;
            width: 100%;
            border: 1px solid #ddd;
        }
        .search-bar button {
            border: none;
            background: none;
            position: absolute;
            right: 20px;
            top: 10px;
        }
        .chart-container {
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .card:nth-child(1) .card-body {
            border-left: 5px solid #4e73df;
        }
        .card:nth-child(2) .card-body {
            border-left: 5px solid #f6c23e;
        }
        .card:nth-child(3) .card-body {
            border-left: 5px solid #36b9cc;
        }
        .card:nth-child(4) .card-body {
            border-left: 5px solid #1cc88a;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="user-info">
                <img alt="User Avatar" src="https://placehold.co/30x30" />
                <span>Welcome, William Anderson</span>
                <a class="d-block mt-2" href="#"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
            </div>
            <h2>Admin</h2>
            <nav class="nav flex-column">
                <a class="nav-item nav-link" href="#">Thống kê</a>
                <a class="nav-item nav-link" href="#">Danh sách cài đặt</a>
                <a class="nav-item nav-link" href="/users">Danh sách người dùng</a>
            </nav>
            <a class="d-block mt-4" href="#">Back to home</a>
        </div>
        {{-- @include('partials.sidebar') --}}
        <div class="content">
            <div class="search-bar position-relative">
                <input placeholder="Search for..." type="text"/>
                <button><i class="fas fa-search"></i></button>
            </div>
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">THU NHẬP</h5>
                            <p class="card-text">₫ 0,00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SỐ NGƯỜI MỚI ĐĂNG KÝ</h5>
                            <p class="card-text">16</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">NGƯỜI DÙNG HOẠT ĐỘNG</h5>
                            <p class="card-text">20</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">SẢN PHẨM</h5>
                            <p class="card-text">19</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tổng quan thu nhập</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="incomeChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Revenue Sources</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                Copyright © Your Website 2021
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5i5