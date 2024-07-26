<?php
require 'header.php';
$conn = new mysqli('localhost', 'root', '', 'Web_do_choi');
$maloaisanpham='';
$chitietloaisanpham='';
if(isset($_GET['chitietloaisp']))
{
    $chitietloaisanpham=$_GET['chitietloaisp'];

}
if(isset($_GET['loaisp']))
{
    $maloaisanpham=$_GET['loaisp'];

}
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
        
        $sobanghi1trang = 6;
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $tranghientai = $_GET['page'];
        } else {
            $tranghientai = 1;
        }
        $vitribanghibatdau = ($tranghientai - 1) * $sobanghi1trang;
        if($chitietloaisanpham!='')
        {
            $sql = "SELECT * FROM sanpham where MaLoai='$maloaisanpham' AND ChiTietLoai='$chitietloaisanpham' LIMIT $vitribanghibatdau, $sobanghi1trang";
        }else{
            $sql = "SELECT * FROM sanpham where MaLoai='$maloaisanpham' LIMIT $vitribanghibatdau, $sobanghi1trang";
        }
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
        if($chitietloaisanpham!='')
        {
            $sql = "SELECT Count(*) AS soluongsp From sanpham Where MaLoai='$maloaisanpham' AND ChiTietLoai='$chitietloaisanpham'";
        }else{
            $sql = "SELECT Count(*) AS soluongsp From sanpham where MaLoai='$maloaisanpham'";
        }
        // $sql = "SELECT Count(*) AS soluongsp From sanpham";
        $kq = $conn->query($sql);
        $row = $kq->fetch_assoc();
        $soluongsp = $row['soluongsp'];
        $sotrang = ceil($soluongsp / $sobanghi1trang);
        if($chitietloaisanpham!='')
        {
            for ($i = 1; $i <= $sotrang; $i++) {
                echo "<a href='PhanLoaiSP.php?loaisp=".$maloaisanpham."&chitietloaisp=".$chitietloaisanpham."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
            }
        }else{
            for ($i = 1; $i <= $sotrang; $i++) {
                echo "<a href='PhanLoaiSP.php?loaisp=".$maloaisanpham."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
            }
        }
        // for ($i = 1; $i <= $sotrang; $i++) {
        //     echo "<a href='#' class='btn btn-default'>" . $i . "</a>";
        // }
        ?>
    </div>
</div>
    </section>
    <div class="footer">
        <p>© 2024 Trang Web PHP. Tất cả quyền được bảo lưu.</p>
    </div>

   </div>
   

</body>
</html>