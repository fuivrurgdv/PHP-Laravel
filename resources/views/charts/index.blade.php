{{-- @extends('layouts.app')

@section('content')
    <div class="container pt-5 mb-5">
        <h2 style="font-weight: bold">Trang chủ</h2>
        <div class="row">
            <div class="col-md-3">
                @include('sidebar.sidebar')
            </div>
            <div class="col-md-9">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="employee-ratio-tab" data-bs-toggle="tab" href="#employee-ratio"
                            role="tab" aria-controls="employee-ratio" aria-selected="true">Tỷ lệ nhân viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="gender-chart-tab" data-bs-toggle="tab" href="#gender-chart" role="tab"
                            aria-controls="gender-chart" aria-selected="false">Thống kê giới tính</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contract-type-tab" data-bs-toggle="tab" href="#contract-type" role="tab"
                            aria-controls="contract-type" aria-selected="false">Loại hợp đồng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="attendance-tab" data-bs-toggle="tab" href="#attendance" role="tab"
                            aria-controls="attendance" aria-selected="false">Thống kê điểm danh</a>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content mt-4">
                    <div class="tab-pane fade show active" id="employee-ratio" role="tabpanel"
                        aria-labelledby="employee-ratio-tab">
                        @include('charts.employee_ratio_chart')
                    </div>
                    <div class="tab-pane fade" id="gender-chart" role="tabpanel" aria-labelledby="gender-chart-tab">
                        @include('charts.gender_chart')
                    </div>
                    <div class="tab-pane fade" id="contract-type" role="tabpanel" aria-labelledby="contract-type-tab">
                        @include('charts.contract_type_chart')
                    </div>
                    <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                        @include('charts.attendance_chart')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biểu đồ thống kê</title>

    <!-- Font và CSS -->
    <link href="{{ asset('fe-access/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('fe-access/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Custom CSS -->
    <style>
        .button-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #4e73df; /* Màu xanh dương đậm */
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #2e59d9; /* Màu xanh dương sáng */
            color: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4e73df;
            font-weight: bold;
        }

        .container-fluid {
            max-width: 800px;
            margin: auto;
        }

        .text-center {
            margin-bottom: 20px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.slidebar') <!-- Thanh bên -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.topbar') <!-- Thanh trên -->

                <!-- Biểu đồ tỷ lệ nhân viên giữa các phòng ban -->
                {{-- <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Biểu đồ thống kê</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body text-center">
                            <div class="button-container">
                                <a href="{{ route('employee.ratio') }}" class="btn btn-primary">
                                    <i class="fas fa-users"></i> Thống kê nhân sự giữa các phòng ban
                                </a>
                                <a href="{{ route('gender.ratio') }}" class="btn btn-primary">
                                    <i class="fas fa-venus-mars"></i> Thống kê giới tính theo phòng ban
                                </a>
                                <a href="{{ route('attendance.ratio.view') }}" class="btn btn-primary">
                                    <i class="fas fa-check-circle"></i> Tỉ lệ chấm công của nhân viên
                                </a>
                                <a href="{{ route('age.ratio') }}" class="btn btn-primary">
                                    <i class="fas fa-birthday-cake"></i> Thống kê độ tuổi của nhân viên theo phòng ban
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-9">
                    <!-- Nav tabs -->
                    {{-- <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="employee-ratio-tab" data-bs-toggle="tab" href="#employee-ratio"
                                role="tab" aria-controls="employee-ratio" aria-selected="true">Tỷ lệ nhân viên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="gender-chart-tab" data-bs-toggle="tab" href="#gender-chart" role="tab"
                                aria-controls="gender-chart" aria-selected="false">Thống kê giới tính</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contract-type-tab" data-bs-toggle="tab" href="#contract-type" role="tab"
                                aria-controls="contract-type" aria-selected="false">Loại hợp đồng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="attendance-tab" data-bs-toggle="tab" href="#attendance" role="tab"
                                aria-controls="attendance" aria-selected="false">Thống kê điểm danh</a>
                        </li>
                    </ul> --}}
    
                    <!-- Tab content -->
                    <div class="tab-content mt-4">
                        <div class="tab-pane fade show active" id="employee-ratio" role="tabpanel"
                            aria-labelledby="employee-ratio-tab"> 
                            @include('charts.employee_ratio_chart')
                        </div>
                        <div class="tab-pane fade show active" id="gender-chart" role="tabpanel" aria-labelledby="gender-chart-tab">
                            @include('charts.gender_chart')
                        </div>
                        {{-- <div class="tab-pane fade show active" id="contract-type" role="tabpanel" aria-labelledby="contract-type-tab">
                            @include('charts.contract_type_chart')
                        </div> --}}
                        <div class="tab-pane fade show active" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                            @include('charts.attendance_chart')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            {{-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>© {{ date('Y') }} Your Company. All Rights Reserved.</span>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- JavaScript -->
    <script src="{{ asset('fe-access/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('fe-access/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fe-access/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('fe-access/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #employeeRatioChart,
        #contractTypeChart,
        #genderChart {
            width: 100%;
            /* Chiều rộng mặc định */
            max-width: 600px;
            /* Đặt giới hạn chiều rộng tối đa */
            height: 400px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Chiều cao cụ thể */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
</body>

</html>
