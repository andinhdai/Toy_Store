<?php
require 'header.php';
$conn = $conn =new mysqli('localhost','root','','Web_do_choi');

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    // Truy vấn dữ liệu
    $sql = "SELECT DATE_FORMAT(NgayLap, '%Y-%m') AS Thang, SUM(TongTien) AS TongTien FROM HoaDon GROUP BY DATE_FORMAT(NgayLap, '%Y-%m')";
    $result = mysqli_query($conn, $sql);

    // Khởi tạo mảng chứa dữ liệu
    $labels = [];
    $data = [];

    // Lặp qua kết quả truy vấn để lấy dữ liệu
    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['Thang'];
        $data[] = $row['TongTien'];
    }

    // Đóng kết nối
    mysqli_close($conn);
?>

<section>
<div id="left-menu" class="col-md-3">
<div id="left-menu" class="col-md-3">
            <!-- Menu bên trái -->
            <h4><a style="color: white" href="Giaodienchinh.php">Trang chủ</a></h4>
            <!-- Danh sách các loại sản phẩm -->
            
        </div>    
        </div>
    <div id="main-content" class="col-md-9">
        <div class="thumbnail">
        <canvas id="myChart" width="800" height="400"></canvas>
        <script>
        // Sử dụng chart.js để vẽ biểu đồ
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Số tiền bán được theo tháng',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
        </div>
    </div>
</section>

<div class="footer">
    <p>Họ Tên : An Đình Đại - Ngày sinh: 28/3/2002</p>
<p>Họ Tên : Đỗ Minh Hiếu - Ngày sinh: 21/4/2002</p>
<p>Họ Tên : Lê Quang Minh - Ngày sinh: 03/8/2002</p>
</div>

</div>
</body>
</html>