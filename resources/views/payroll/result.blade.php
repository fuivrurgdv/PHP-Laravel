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
                    {{-- <h1 class="text-center my-4">Tính Lương Nhân Viên</h1> --}}

                    <!-- Thông báo -->
                    @if(session('success'))
                        <div class="alert alert-success text-center my-3">
                            {{ session('success') }}
                        </div>
                    @endif


                    <!-- Bảng thông tin -->
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            {{-- <tr>
                                <th>Nhân viên</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Hệ số lương</th>
                                <td>{{ $salaryCoefficient }}</td>
                            </tr>
                            <tr>
                                <th>Số ngày công hợp lệ</th>
                                <td>{{ $validDays }}</td>
                            </tr>
                            <tr>
                                <th>Số ngày công không hợp lệ</th>
                                <td>{{ $invalidDays }}</td>
                            </tr>
                            <tr>
                                <th>Lương nhận được</th>
                                <td>{{ number_format($salaryReceived, 0) }} VND</td>
                            </tr>
                             --}}
                                <thead class="table-white">
                                    <tr style="color: black">
                                        <th>Nhân viên</th>
                                        <th>Ngày công hợp lệ</th>
                                        <th>Ngày công không hợp lệ</th>
                                        {{-- <th>Hệ số lương</th> --}}
                                        <th>Lương nhận được</th>
                                        {{-- <th>Ngày tính lương</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $validDays }}</td>
                                            <td>{{ $invalidDays }}</td>
                                            <td>{{ number_format($salaryReceived, 0) }} VND</td>
                                            
                                        </tr>
                                    
                                </tbody>
                            
                        </table>
                    </div>
                    <a onclick="window.location.href='/payroll/calculate'" class="btn btn-primary">Quay lại</a>
                    <a href="{{ route('payroll.store') }}" class="btn btn-success"
                    onclick="event.preventDefault(); 
                         document.getElementById('payroll-form').submit();">
                    Lưu trữ tính lương
                </a>

                <form id="payroll-form" action="{{ route('payroll.store') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="salary_received" value="{{ $salaryReceived }}">
                    <input type="hidden" name="valid_days" value="{{ $validDays }}">
                    <input type="hidden" name="invalid_days" value="{{ $invalidDays }}">
                    {{-- <input type="hidden" name="salary_coefficient" value="{{ $salaryCoefficient }}"> --}}
                </form>

                
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