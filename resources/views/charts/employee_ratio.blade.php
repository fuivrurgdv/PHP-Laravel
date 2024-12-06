<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biểu đồ tỷ lệ nhân sự</title>
    <link href="{{ asset('fe-access/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('fe-access/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        .chart-container {
            position: relative;
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.slidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('admin.topbar')
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Biểu đồ tỷ lệ nhân sự giữa các phòng ban</h1>
                    <div class="mb-4">
                        {{-- <a href="{{ route('chart.view') }}" class="btn btn-danger">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a> --}}
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="employeeRatioChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script src="{{ asset('fe-access/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('fe-access/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fe-access/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('fe-access/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        document.addEventListener('DOMContentLoaded', loadEmployeeRatioChart);

//         async function loadEmployeeRatioChart() {
//     try {
//         const response = await fetch('api/user-count-by-department');
//         const data = await response.json();

//         if (!data.labels || !data.counts || data.labels.length === 0) {
//             document.querySelector('.chart-container').innerHTML = '<p class="text-center text-danger">Không có dữ liệu hoặc dữ liệu không hợp lệ.</p>';
//             return;
//         }

//         if (data.labels.length !== data.counts.length) {
//             document.querySelector('.chart-container').innerHTML = '<p class="text-center text-danger">Dữ liệu không khớp, vui lòng thử lại sau.</p>';
//             return;
//         }

//         // Tạo mảng màu ngẫu nhiên hoặc cố định
//         const colors = [
//             'rgba(75, 192, 192, 0.6)',  // Xanh nhạt
//             'rgba(153, 102, 255, 0.6)', // Tím nhạt
//             'rgba(255, 159, 64, 0.6)',  // Cam
//             'rgba(54, 162, 235, 0.6)',  // Xanh dương
//             'rgba(255, 99, 132, 0.6)',  // Đỏ
//             'rgba(255, 205, 86, 0.6)',  // Vàng
//         ];

//         // Sử dụng màu theo số lượng mục
//         const backgroundColors = data.labels.map((_, index) => colors[index % colors.length]);

//         const ctx = document.getElementById('employeeRatioChart').getContext('2d');

//         new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 labels: data.labels,
//                 datasets: [{
//                     label: 'Tỉ lệ nhân sự',
//                     data: data.counts,
//                     backgroundColor: backgroundColors,
//                     borderColor: '#4A5568',
//                     borderWidth: 1,
//                 }]
//             },
//             options: {
//                 responsive: true,
//                 maintainAspectRatio: false,
//                 plugins: {
//                     legend: {
//                         display: true,
//                         position: 'top',
//                     },
//                     tooltip: {
//                         callbacks: {
//                             label: function(context) {
//                                 return context.dataset.label + ': ' + context.raw;
//                             }
//                         }
//                     }
//                 },
//                 scales: {
//                     x: {
//                         title: {
//                             display: true,
//                             text: 'Phòng ban',
//                         }
//                     },
//                     y: {
//                         beginAtZero: true,
//                         title: {
//                             display: true,
//                             text: 'Số lượng nhân sự',
//                         }
//                     }
//                 }
//             }
//         });
//     } catch (error) {
//         console.error('Error fetching chart data:', error);
//         document.querySelector('.chart-container').innerHTML = '<p class="text-center text-danger">Không thể tải dữ liệu biểu đồ.</p>';
//     }
// }
async function loadEmployeeRatioChart() {
    try {
        const response = await fetch('api/user-count-by-department');
        const data = await response.json();

        if (!data.labels || !data.counts || data.labels.length === 0) {
            document.querySelector('.chart-container').innerHTML = '<p class="text-center text-danger">Không có dữ liệu hoặc dữ liệu không hợp lệ.</p>';
            return;
        }

        if (data.labels.length !== data.counts.length) {
            document.querySelector('.chart-container').innerHTML = '<p class="text-center text-danger">Dữ liệu không khớp, vui lòng thử lại sau.</p>';
            return;
        }

        // Tạo mảng màu ngẫu nhiên hoặc cố định
        const colors = [
            'rgba(75, 192, 192, 0.6)',  // Xanh nhạt
            'rgba(153, 102, 255, 0.6)', // Tím nhạt
            'rgba(255, 159, 64, 0.6)',  // Cam
            'rgba(54, 162, 235, 0.6)',  // Xanh dương
            'rgba(255, 99, 132, 0.6)',  // Đỏ
            'rgba(255, 205, 86, 0.6)',  // Vàng
        ];

        // Sử dụng màu theo số lượng mục
        const backgroundColors = data.labels.map((_, index) => colors[index % colors.length]);

        const ctx = document.getElementById('employeeRatioChart').getContext('2d');

        new Chart(ctx, {
            type: 'pie', // Biểu đồ tròn
            data: {
                labels: data.labels, // Nhãn (Tên phòng ban)
                datasets: [{
                    label: 'Tỉ lệ nhân sự',
                    data: data.counts, // Dữ liệu (Số lượng nhân sự)
                    backgroundColor: backgroundColors, // Màu sắc của các phần
                    borderColor: '#ffffff', // Màu viền trắng
                    borderWidth: 1, // Độ dày viền
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top', // Vị trí của chú thích
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const percentage = ((context.raw / data.counts.reduce((a, b) => a + b, 0)) * 100).toFixed(2);
                                return `${context.label}: ${context.raw} (${percentage}%)`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#000', // Màu chữ
                        font: {
                            size: 12, // Kích thước chữ
                            weight: 'bold'
                        },
                        formatter: function(value, context) {
                            const percentage = ((value / data.counts.reduce((a, b) => a + b, 0)) * 100).toFixed(2);
                            return `${context.chart.data.labels[context.dataIndex]}\n(${percentage}%)`;
                        },
                        anchor: 'end',
                        align: 'start',
                        offset: -10
                    }
                }
            },
            plugins: [ChartDataLabels] // Kích hoạt plugin datalabels
        });
    } catch (error) {
        console.error('Error fetching chart data:', error);
        document.querySelector('.chart-container').innerHTML = '<p class="text-center text-danger">Không thể tải dữ liệu biểu đồ.</p>';
    }
}

    </script>
</body>

</html>