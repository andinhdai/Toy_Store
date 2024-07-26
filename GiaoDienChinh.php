<?php
require 'header.php';
$conn = new mysqli('localhost', 'root', '', 'Web_do_choi');
if (isset($_POST['mua'])) {
    $masp = isset($_POST['masp']) ? $_POST['masp'] : '';
    $_SESSION['machitietsp'] = $masp;
    header('Location:ChiTietSanPham.php');
}
?>
    
    <div class="row">
     
        <div id="left-menu" class="col-md-3" >
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
        <div class="carousel slide" id="testcrs" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#testcrs" data-slide-to="0" class="active"></li>
                <li data-target="#testcrs" data-slide-to="1"></li>
                <li data-target="#testcrs" data-slide-to="2"></li>
                <li data-target="#testcrs" data-slide-to="3"></li>
                <li data-target="#testcrs" data-slide-to="4"></li>
                <li data-target="#testcrs" data-slide-to="5"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
            <div class="item active">
                    <img src="./anh/banner.jpg" alt="Banner drip" width="400" height="250">
                </div>
                <div class="item">
                    <img src="./anh/DHM_SP01.jpg" alt="Đồ chơi lắp ghép" width="400" height="250">
                </div>
                <div class="item">
                    <img src="./anh/DHM_SP10.jpg" alt="Đồ chơi mô phỏng" width="400" height="250">
                </div>
                <div class="item">
                    <img src="./anh/DHM_SP11.jpg" alt="Đồ chơi sáng tạo" width="400" height="250">
                </div>
                <div class="item">
                    <img src="./anh/DHM_SP35.jpg" alt="Đồ chơi theo phim" width="400" height="250">
                </div>
                <div class="item">
                    <img src="./anh/DHM_SP44.jpg" alt="Gấu bông" width="400" height="250">
                </div>
            </div>
            <a class="left carousel-control" href="#testcrs" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#testcrs" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div id="chiasp" class="row">
        <?php
        
        $sobanghi1trang = 8;
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $tranghientai = $_GET['page'];
        } else {
            $tranghientai = 1;
        }
        $vitribanghibatdau = ($tranghientai - 1) * $sobanghi1trang;
        $sql = "SELECT * FROM sanpham LIMIT $vitribanghibatdau, $sobanghi1trang";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "
                <div class='col-md-3'>
                    <div class='thumbnail'>
                        <img src='" . $row['HinhAnh'] . "' alt='" . $row['TenSP'] . "'>
                        <div class='caption'>
                            <h4>" . $row['TenSP'] . "</h4>
                            <p>" . number_format($row['DonGia']) . " VNĐ</p>
                            <p>
                                <form method='post'>
                                    <button type='submit' name='mua' class='btn btn-primary'>Chi tiết sản phẩm</button>
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
        <div id="PhanTrang" class="text-center">
            <?php
            $sql = "SELECT Count(*) AS soluongsp From sanpham";
            $kq = $conn->query($sql);
            $row = $kq->fetch_assoc();
            $soluongsp = $row['soluongsp'];
            $sotrang = ceil($soluongsp / $sobanghi1trang);
            for ($i = 1; $i <= $sotrang; $i++) {
                echo "<a href='GiaoDienChinh.php?page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
            }
            ?>
        </div>
    </div>
        </row>
    <div class="footer">
        <p>Họ Tên : An Đình Đại - Ngày sinh: 28/3/2002</p>
        <p>Họ Tên : Đỗ Minh Hiếu - Ngày sinh: 21/4/2002</p>
        <p>Họ Tên : Lê Quang Minh - Ngày sinh: 03/8/2002</p>
    </div>

   </div>
   

</body>
</html>