<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lêu Lêu</title>

    <!-- Custom fonts and styles-->
    <link href="/fe-access/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="/fe-access/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .input-group {
            border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input-group input {
            border: none;
            padding: 15px;
            font-size: 16px;
        }

        .input-group input:focus {
            outline: none;
            box-shadow: none;
        }

        .input-group .btn {
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 0;
        }

        .input-group .btn:hover {
            background-color: #2e59d9;
        }

        .action-btns a, .action-btns button {
            margin-right: 5px;
        }

        .action-btns .btn {
            border-radius: 5px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('fe_admin.slidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('fe_admin.topbar')

                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div >
                        <h1 class="h3 mb-0 text-gray-800">Danh sách Bậc Lương</h1>
                        {{-- <div class="d-flex align-items-center"> --}}
                            {{-- <a href="{{ route('salary.create') }}" class="btn btn-primary mr-2">Thêm cấp bậc lương</a> --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">
                                Thêm bậc lương
                            </button>
                            <form method="GET" action="{{ route('salary') }}" class="form-inline">
                                <div class="form-group mb-2">
                                    <label for="search_salary" class="sr-only">Nhập tên cấp bậc:</label>
                                    <input type="text" class="form-control mr-2" id="search_salary" name="search_salary" value="{{ request()->input('search_salary') }}" placeholder="Nhập tên cấp bậc">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">
                                    <i class="fas fa-search"></i> <!-- Thay đổi icon ở đây -->
                                </button>
                            </form>
                        {{-- </div> --}}
                    </div>

                    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Cập nhật thông tin người dùng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('salary.store') }}" method="POST" class="p-4 bg-white shadow rounded">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Cấp Bậc:</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Nhập tên bậc lương" required>
                                    </div>
            
                                    {{-- <div class="mb-3">
                                        <label for="monthly_salary" class="form-label">Lương Tháng:</label>
                                        <input type="text" name="monthly_salary" id="monthly_salary"
                                               class="form-control money-input" placeholder="Nhập lương tháng" required>
                                        {{-- <small id="monthly_display" class="form-text text-muted">
                                            Bạn đã nhập: 0 ₫
                                        </small> --}}
                                    {{-- </div> --}} 
            
                                    <div class="mb-3">
                                        <label for="daily_salary" class="form-label">Lương Ngày:</label>
                                        <input type="text" name="daily_salary" id="daily_salary"
                                               class="form-control money-input" placeholder="Nhập lương ngày" required>
                                        {{-- <small id="daily_display" class="form-text text-muted">
                                            Bạn đã nhập: 0 ₫
                                        </small> --}}
                                    </div>
            
                                    <!-- Nút Quay Lại và Thêm ở cùng một hàng -->
                                    <div class="d-flex justify-content-between mt-4">
                                        {{-- <a href="{{ route('salary') }}" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left"></i> Quay Lại
                                        </a> --}}
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-white">
                                <tr style="color: black">
                                    <th>STT</th>
                                    <th>Bậc</th>
                                    {{-- <th>Lương Tháng</th> --}}
                                    <th>Lương Ngày</th>
                                    <th>Chức năng </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salarylevels as $salaryLevel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $salaryLevel->name }}</td>
                                        {{-- <td>{{ number_format($salaryLevel->monthly_salary, 0, ',', '.') }} VND</td> --}}
                                        <td>{{ number_format($salaryLevel->daily_salary, 0, ',', '.') }} VND</td>
                                        <td class="action-btns">
                                            {{-- <a href="{{ route('salary.show', $salaryLevel->id) }}" class="btn btn-primary">
                                                <i class="fas fa-info-circle"></i>
                                            </a> --}}
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#detailModal"><i class="fas fa-info-circle"></i></button>
                                            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detailModal" style="color: black">Thông tin bậc lương</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                {{-- <div class="card-header">
                                                                    Thông tin cấp bậc
                                                                </div> --}}
                                                                <div class="card-body">
                                                                    <h5 class="card-title">Tên cấp bậc: {{ $salaryLevel->name }}</h5>
                                                                    {{-- <p class="card-text">Lương tháng: {{ number_format($salaryLevel->monthly_salary, 0, '.', ',') }} VND</p> --}}
                                                                    <p class="card-text">Lương ngày: {{ number_format($salaryLevel->daily_salary, 0, '.', ',') }} VND</p>
                                                                    <p class="card-text">Trạng thái: 
                                                                        {{ $salaryLevel->status == 1 ? 'Hoạt động' : 'Vô hiệu hóa' }}
                                                                    </p>                            <p class="card-text">
                                                                        {{-- Ngày tạo: {{ $salaryLevel->created_at->format('d/m/Y') }}</p> --}}
                                                                    <p class="card-text">Người tạo: {{ $salaryLevel->creator ? $salaryLevel->creator->name : 'N/A' }}</p>
                                                                    {{-- <p class="card-text">Ngày cập nhật: {{ $salaryLevel->updated_at->format('d/m/Y') }}</p>
                                                                    <p class="card-text">Người cập nhật: {{ $salaryLevel->updater ? $salaryLevel->updater->name : 'N/A' }}</p> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#editModal"><i class="fas fa-wrench"></i></button>
                                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel" style="color: black">Chỉnh sửa bậc lương</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('salary.update', $salaryLevel->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="name">Tên cấp bậc</label>
                                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $salaryLevel->name }}" required>
                                                                </div>
                                                                {{-- <div class="form-group">
                                                                    <label for="monthly_salary">Lương tháng</label>
                                                                    <input type="text" class="form-control" id="monthly_salary" name="monthly_salary" value="{{ number_format($salaryLevel->monthly_salary, 0, '.', ',') }}" required>
                                                                </div> --}}
                                                                <div class="form-group">
                                                                    <label for="daily_salary">Lương ngày</label>
                                                                    <input type="text" class="form-control" id="daily_salary" name="daily_salary" value="{{ number_format($salaryLevel->daily_salary, 0, '.', ',') }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Trạng thái</label>
                                                                    <select name="status" class="form-control" required>
                                                                        <option value="1">Hoạt động</option>
                                                                        <option value="0">Vô hiệu hóa</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <form action="{{ route('salary_levels.destroy', $salaryLevel) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    {{-- <div class="copyright text-center my-auto">
                        <span>© {{ date('Y') }} Your Company. All Rights Reserved.</span>
                    </div> --}}
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ''); // Chỉ giữ lại số
            input.value = new Intl.NumberFormat('vi-VN').format(value); // Định dạng theo VN
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="fe-access/vendor/jquery/jquery.min.js"></script>
    <script src="fe-access/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fe-access/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="fe-access/js/sb-admin-2.min.js"></script>
</body>

</html>
