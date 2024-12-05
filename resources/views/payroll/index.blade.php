<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Font và CSS -->
    <link href="/fe-access/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="/fe-access/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.slidebar') <!-- Thanh bên -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.topbar') <!-- Thanh trên -->

                <div class="container-fluid">
                    <!-- Nút quay lại -->
                    {{-- <div class="d-flex justify-content-start mt-4">
                        <button onclick="window.history.back();" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </button>
                    </div> --}}

                    <!-- Tiêu đề -->
                    <h1 class="text-center my-4">Tính Lương Nhân Viên</h1>

                    <!-- Thông báo -->
                    @if(session('success'))
                        <div class="alert alert-success text-center my-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('payroll.calculate') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Chọn nhân viên:</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value=""> Chọn nhân viên </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Tính Lương</button>
                        <a href="{{ route('run.payroll.calculate') }}" class="btn btn-primary mt-3">Tính lương cho tất cả nhân
                            viên</a>
                    </form>

                    <!-- Bảng thông tin -->
                    

                    <!-- Nút lưu trữ -->
                    {{-- <div class="text-center mt-4">
                        <form method="POST" action="{{ route('save.salary') }}">
                            @csrf
                            <button type="submit" class="btn btn-success px-4 py-2">
                                <i class="fas fa-save"></i> Lưu Lương
                            </button>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>


        <!-- Footer -->
        
    </div>
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            {{-- <div class="copyright text-center my-auto">
                <span>© {{ date('Y') }} Your Company. All Rights Reserved.</span>
            </div> --}}
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="/fe-access/vendor/jquery/jquery.min.js"></script>
    <script src="/fe-access/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="/fe-access/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages -->
    <script src="/fe-access/js/sb-admin-2.min.js"></script>
</body>

</html>