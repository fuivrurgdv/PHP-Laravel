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
    <link href="fe-access/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="fe-access/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Đưa nút xuống dưới */
.d-flex.justify-content-between {
    flex-direction: column;
    align-items: center;
}

.d-flex.justify-content-center {
    margin-top: 1rem;
}

    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('user.slidebar') <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.topbar') <!-- Topbar -->

                <div class="container-fluid">
                   

                    <!-- Hiển thị thông báo nếu có -->
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                   
                    <!-- Lịch sử Check In/Out -->
                    <div class="d-flex justify-content-between mb-4">
                        <h3 class="text-center" style="color: black">Lịch sử Check In/Out</h3>
                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <form action="{{ route('attendance.checkin') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{-- <i class="fas fa-sign-in-alt"></i>  --}}
                                    Check In
                                </button>
                            </form>
    
                            <form action="{{ route('attendance.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-lg">
                                    {{-- <i class="fas fa-sign-out-alt"></i>  --}}
                                    Check Out
                                </button>
                            </form>
                        </div>
                        {{-- <h4 class="text-center">Ngày {{ date('d/m/Y') }}</h4> --}}
                        <button class="btn btn-warning" data-toggle="modal" data-target="#leaveRequestModal"><i class="fas fa-paper-plane"></i></button>
                                            <div class="modal fade" id="leaveRequestModal" tabindex="-1" role="dialog" aria-labelledby="leaveRequestModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="leaveRequestModal" style="color: black">Gửi đơn xin nghỉ</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('leave.request') }}" method="POST" id="leaveForm">
                                                                @csrf
                                                                
                                      
                                                                <div class="form-group">
                                                                    <label for="leave_type" class="form-label">Loại nghỉ</label>
                                                                    <select class="form-select" id="leave_type" name="leave_type" required>
                                                                        <option value="morning">Nghỉ buổi sáng</option>
                                                                        <option value="afternoon">Nghỉ buổi chiều</option>
                                                                        
                                                                        <option value="multiple_days">Nghỉ nhiều ngày</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group " id="datePickerContainer" >
                                                                    
                                                                    <label for="start_date" class="form-label">Từ ngày</label>
                                                                        <input type="date" class="form-control" id="start_date" name="start_date">

                                                                        <label for="end_date" class="form-label mt-2" id="end_date_label" style="display: none;">
                                                                            Đến ngày
                                                                        </label>
                                                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                                                            style="display: none;">
                                                                </div>
                                                                <div class="form-group "  >
                                                                    
                                                                    <label for="reason" class="form-label">Lý do nghỉ</label>
                                                                    <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Gửi</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    </div>
                  
                    <table class="table table-striped table-bordered text-center">
                        <thead class="table-white">
                            <tr style="color: black">
                                <th>STT</th>
                                {{-- <th>Nhân viên</th> --}}
                                <th>Loại</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th> <!-- New Status Column -->

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $attendance->user->name }}</td> --}}
                                <td>{{ ucfirst($attendance->type) }}</td> <!-- Checkin/Checkout -->
                                <td>{{ $attendance->time->format('H:i d/m/Y') }}</td>
                                <td>
                                    {{-- {{ $attendance->status ? 'Hợp lệ' : 'Không hợp lệ' }} <!-- Hiển thị trạng thái --> --}}
                                    @if ($attendance->status == 1)
                                            <p class="text-success">Hợp lệ</p>
                                        @elseif ($attendance->status == 0)
                                            <p class="text-danger">Không hợp lệ</p>
                                        @elseif ($attendance->status == 3)
                                            <p>Đang xem xét</p>
                                        
                                        @endif
                                </td>
                                <td>
                                    @if ($attendance->status == 0 )
                                        <!-- Button trigger modal -->
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal"><i class="fas fa-paper-plane"></i></button>
                                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel" style="color: black">Giải trình</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('attendance.submit-reason', $attendance->id) }}" method="POST">
                                                                @csrf
                                                                
                                      
                                                                <div class="form-group">
                                                                    <label for="status">Nhập lý do giải trình</label>
                                                                    <select name="reason" class="form-control" id="reasonSelect" required>
                                                                        <option value="Tắc
                                                                            đường">Tắc
                                                                            đường</option>
                                                                        <option value="Thủng lốp">Thủng lốp</option>
                                                                        <option value="other">Lý do khác</option>
                                                                            
                                                                    </select>
                                                                </div>
                                                                <div class="form-group " id="otherReasonText" style="display: none;">
                                                                    
                                                                    <label for="customReason">Lý do khác:</label>
                                                                    <textarea name="custom_reason" id="customReason" class="form-control"></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Gửi</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $attendances->links() }}
           
            {{-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>© {{ date('Y') }} Your Company. All Rights Reserved.</span>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="fe-access/vendor/jquery/jquery.min.js"></script>
    <script src="fe-access/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="fe-access/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="fe-access/js/sb-admin-2.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const reasonSelect = document.getElementById("reasonSelect");
            const otherReasonText = document.getElementById("otherReasonText");
    
            reasonSelect.addEventListener("change", function () {
                if (this.value === "other") {
                    otherReasonText.style.display = "block";
                } else {
                    otherReasonText.style.display = "none";
                }
            });
        });
    </script>
    <script>
        // document.getElementById('profileImage').onclick = function() {
        //     document.getElementById('avatarInput').click(); // Kích hoạt input file khi nhấp vào ảnh
        // };
    
        // document.getElementById('avatarInput').onchange = function() {
        //     document.getElementById('avatarForm').submit(); // Gửi form khi chọn file
        // };
    
        document.getElementById('leave_type').addEventListener('change', function() {
            const leaveType = this.value;
            const endDateLabel = document.getElementById('end_date_label');
            const endDateInput = document.getElementById('end_date');
    
            if (leaveType === 'multiple_days') {
                endDateLabel.style.display = 'block';
                endDateInput.style.display = 'block';
                endDateInput.required = true;
            } else {
                endDateLabel.style.display = 'none';
                endDateInput.style.display = 'none';
                endDateInput.required = false;
            }
        });
    </script>
</body>


</html>