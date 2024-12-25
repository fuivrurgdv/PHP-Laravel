<div class="row">
    <div class="col-md-6 mb-4">
        <h2 style="font-weight: bold">Biểu đồ hiển thị tỉ lệ giới tính giữa các phòng ban</h2>
    </div>
    <div class="col-md-6 mb-4">
        <label for="departmentSelect">Chọn phòng ban:</label>
        <select id="departmentSelect" class="form-select mb-3">
            {{-- <option value="">-- Tất cả phòng ban --</option> --}}
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        <canvas id="genderChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
    let genderChart;

    async function loadGenderChart(departmentId = '') {
        try {
            const url = departmentId ? `/api/gender-statistics?department_id=${departmentId}` :
                '/api/gender-statistics';
            const response = await axios.get(url);
            const data = response.data;

            const department = data[0]?.department || 'Tất cả phòng ban';
            const maleCount = data[0]?.male || 0;
            const femaleCount = data[0]?.female || 0;
            // const otherCount = data[0]?.other || 0;

            if (genderChart) {
                genderChart.destroy();
            }

            genderChart = new Chart(document.getElementById('genderChart'), {
                type: 'pie',
                data: {
                    labels: ['Nam', 'Nữ'],
                    datasets: [{
                        data: [maleCount, femaleCount],
                        backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error fetching gender statistics:', error);
        }
    }

    // Gọi khi dropdown thay đổi
    document.getElementById('departmentSelect').addEventListener('change', function() {
        const departmentId = this.value;
        loadGenderChart(departmentId);
    });

    // Tải biểu đồ lần đầu khi không chọn phòng ban
    loadGenderChart();
</script>