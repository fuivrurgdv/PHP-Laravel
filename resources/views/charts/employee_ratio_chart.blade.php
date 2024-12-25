<div class="row">
    <div class="col-md-6 mb-4">
        <!-- Biểu đồ -->
        <canvas id="employeeRatioChart"></canvas>
    </div>
    <div class="col-md-6">
        <h2 style="font-weight: bold">Biểu đồ hiển thị tỉ lệ phòng ban</h2>
        <!-- Hiển thị tổng số nhân viên -->
        <p style="font-size: 23px;" id="totalEmployees">
        </p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    async function loadTotalEmployees() {
        const response = await fetch('/api/total-employees');
        const data = await response.json();

        // document.getElementById('totalEmployees').textContent = `Tổng các nhân sự: ${data.totalEmployees}`;
    }

    // Gọi hàm khi trang tải
    loadTotalEmployees();

    async function loadEmployeeRatioChart() {
        const response = await fetch('/api/employee-ratio-by-department');
        const data = await response.json();

        const colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
            '#E7E9ED', '#76FF03', '#FF6F00', '#8E24AA'
        ];

        new Chart(document.getElementById('employeeRatioChart'), {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Tỉ lệ nhân sự',
                    data: data.counts,
                    backgroundColor: colors.slice(0, data.labels.length),
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Phòng ban',
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Thiết lập bước giá trị
                            callback: function(value) {
                                return Math.round(value); // Hiển thị số nguyên
                            }
                        },
                        title: {
                            display: true,
                            text: 'Số lượng nhân sự',
                        }
                    }
                }
            }
        });
    }

    loadEmployeeRatioChart();
</script>
