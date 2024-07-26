<?php
require 'header.php';
?>

<section>
<div id="left-menu" class="col-md-3">
<div id="left-menu" class="col-md-3">
            <!-- Menu bên trái -->
            <h4><a style="color: white" href="Giaodienchinh.php">Trang chủ</a></h4>
            <!-- Danh sách các loại sản phẩm -->
            
        </div>    
        </div>
    <div id="main-content" class="col-md-12">
        <div class="thumbnail">
            <?php
            $conn = new mysqli('localhost', 'root', '', 'testcmtsp');

            $id_hoadon = $_SESSION['Id_HoaDon'];
            $ArraySP = $_SESSION['DS_SP'];
            $tong=$_SESSION['tongtien'];
            $sql = "SELECT * FROM hoadon where Id_HoaDon='$id_hoadon'";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "
                    <div id='hoadon'>
                        <table >
                            <caption>HÓA ĐƠN</caption>
                            <tr>
                                <th>Tên người nhận:</th>
                                <th>" . $row['TenNguoiNhan'] . "</th>
                            </tr>
                            <tr>
                                <th>Số điện thoai:</th>
                                <th>" . $row['SdtNhan'] . "</th>
                            </tr>
                            <tr>
                                <th>Địa chỉ:</th>
                                <th>" . $row['DiaChiNhan'] . "</th>
                            </tr>
                            <tr>
                                <th>Ghi chú:</th>
                                <th>" . $row['Note'] . "</th>
                            </tr>
                            <tr>
                                <th colspan='2'>Sản phẩm đã mua:</th>
                            </tr>
                ";

                foreach ($ArraySP as $SP) {
                    echo "
                    <tr>
                    <td>
                        <div class='ttsp'>
                            <span class='tensp'>" . $SP->getTenSP() . "</span>
                            <img class='anhsp' src='" . $SP->getHinhAnh() . "' >
                            
                        </div>
                    </td>
                    <td>
                    <div class='ttsp'>
                            
                            Giá : <span class='giasp'>" . $SP->getThanhTien() . "</span>
                        </div>
                    </td>
                </tr>
                
                    ";
                }
                echo "
                            <tr>
                                <th>Tổng tiền :</th>
                                <th>" . $tong . "</th>
                            </tr>
                        </table>
                    </div>
                ";
            }
            ?>
            <div id="thanks">
                
                <p>Cảm ơn quý khách đã mua sản phẩm ở shop !!!</p>
                
            </div>
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
