<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Danh sách người dùng</title>

    <!-- Custom fonts for this template-->
    <link href="/fe-access/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/fe-access/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc;
        }
    
        h2 {
            color: #4e73df;
        }
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
    
        th,
        td {
            text-align: center;
            padding: 12px;
            border: 1px solid #020202;
        }
    
        th {
            background-color: ; /* Màu nền đen */
            color:blawhite; /* Màu chữ trắng */
        }
    
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    
        tr:hover {
            background-color: #e9ecef;
        }
    
        .form-group {
            margin-bottom: 20px;
        }
    
        .form-control {
            width: auto;
            display: inline-block;
            margin-right: 10px;
        }
    
        .btn-submit {
            padding: 10px 20px;
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    
        .btn-submit:hover {
            background-color: #2e59d9;
        }
    
        .filter-form {
            margin-bottom: 20px;
        }
    </style>
    
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.slidebar') <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.topbar') <!-- Topbar -->

                <div class="container-fluid">
                    
                    <h3 class="mb-4">Quản lý giải trình</h3>
                    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    <table class="table table-bordered ">
        <thead class="table-white">
            <tr style="color: black">
                <th>STT</th>
                <th>Nhân viên</th>
                <th>Thời gian</th>
                <th>Loại</th>
                <th>Lý do giải trình</th>
                <th>Yêu cầu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendingRequests as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->user->name }}</td>
                    <td>{{ $attendance->time->format('H:i d/m/Y') }}</td>
                    <td>{{ ucfirst($attendance->type) }}</td>
                    <td>{{ $attendance->justification ?? 'Chưa có giải trình' }}</td>
                    <td>
                        <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                        <form action="{{ route('attendance.requests.accept', $attendance->id) }}" method="POST"
                            class="mr-2" style="margin-right: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Chấp nhận</button>
                        </form>
                        <form action="{{ route('attendance.requests.reject', $attendance->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Từ chối</button>
                        </form>
                    </div>
                    </td>
                </tr>
                @empty
                <p>Không có đơn nào đang chờ xử lý.</p>
            @endforelse
        </tbody>
    </table>

    <!-- Hiển thị phân trang -->
    {{ $pendingRequests->links() }}
                </div>
            </div>            
        </div>
    </div>
    {{-- <footer class="sticky-footer bg-white mt-auto">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>© {{ date('Y') }} Your Company. All Rights Reserved.</span>
            </div>
        </div>
    </footer> --}}
</div>
</div>

<!-- Scroll to Top Button -->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- JavaScript -->
<script src="fe-access/vendor/jquery/jquery.min.js"></script>
<script src="fe-access/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="fe-access/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="fe-access/js/sb-admin-2.min.js"></script>
</body>

</html>