<?php
require 'header.php';
$conn = new mysqli('localhost', 'root', '', 'Web_do_choi');
if (isset($_POST['mua'])) {
    $masp = isset($_POST['masp']) ? $_POST['masp'] : '';
    $_SESSION['machitietsp'] = $masp;
    header('Location:ChiTietSanPham.php');
}
?>
    <section>
        <div id="left-menu" class="col-md-3">
            <ul class="menu">
                <?php
                    $sqlloaisp="SELECT * FROM loaisp ";
                    $layloaisp= $conn->query($sqlloaisp);
                    if($layloaisp)
                    {
                        while($loaisp=$layloaisp->fetch_assoc())
                        {
                            $maloai = $loaisp['MaLoai'];
                            echo"
                            <li class='menu-item'>
                                <a href='PhanLoaiSP.php?loaisp=".$maloai."' class='submenu-item'>".$loaisp['TenLoai']."<span class='glyphicon glyphicon-chevron-down'></span></a>
                                <ul class='submenu'>
                                ";
                            $sqlchitietloai = "SELECT * FROM chitietloai WHERE MaLoai='$maloai'";
                            $laychitietloai = $conn->query($sqlchitietloai);
                            if($laychitietloai)
                            {
                                while($chitietloai=$laychitietloai->fetch_assoc())
                                {
                                    $tenchitiet=$chitietloai['ChiTietLoai'];
                                    echo"
                                        <li class='submenu-item'><a href='PhanLoaiSP.php?loaisp=".$maloai."& chitietloaisp=".$tenchitiet."'>".$tenchitiet."</a></li>
                                    ";
                                }
                                echo"
                                    </ul>
                                </li>
                                ";
                            }   
                        }
                    }
                ?>
            </ul>
        </div>
        <div id="main-content" class="col-md-12">
        <div id="chiasp" class="row">
        <?php
        $sql = "SELECT * FROM sanpham order by DaBan DESC LIMIT 5 ";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "
                <div class='col-md-4'>
                    <div class='thumbnail'>
                        <img src='" . $row['HinhAnh'] . "' alt='" . $row['TenSP'] . "'>
                        <div class='caption'>
                            <h4>" . $row['TenSP'] . "</h4>
                            <p>" . number_format($row['DonGia']) . " VNĐ</p>
                            <p>
                                <form method='post'>
                                    <button type='submit' name='mua' class='btn btn-primary'>Mua</button> <span id='spdaban'>Đã bán : ".$row['DaBan']."</span>
                                    <input type='hidden' name='masp' value='" . $row['MaSP'] . "'>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            ";
        }
        ?>
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