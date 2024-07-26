
<?php
require_once 'header.php';
$Array = array();
$masp = $_SESSION['machitietsp'];
$tb = '';
$conn =new mysqli('localhost','root','','Web_do_choi');
if(isset($_POST['themvaogio']))
{
    if($_SESSION['uid']!='')
    {
        $soluongmua = isset($_POST['soluongmua']) ? $_POST['soluongmua'] : '';
        $soluongcon = isset($_POST['soluongcon']) ? $_POST['soluongcon'] : '';
        $dongia = isset($_POST['dongia']) ? $_POST['dongia'] : '';
        $userid = $_SESSION['uid'];
        $Array = $_SESSION['Ds_GioHang'];
        $ktra = false ;
        $idGioUpDate='';
        $updatesoluongmua=0;
        if(!empty($Array))
        {
            $tb = 'Trong giỏ đã có sản phẩm nào đó !!!';
            foreach($Array as $sp) {
                $ktraMaSP = $sp->getMaSP();
                if ($masp == $ktraMaSP) {
                    
                    $idGioUpDate = $sp->getIdGio();
                    $updatesoluongmua = $sp->getSoLuongMua();
                    $ktra = true;
                    $tb = 'Đã có trong giỏ';
                }
            }
        }else{
            $tb = 'Trong giỏ chưa có sản phẩm nào !!!';
        }
        if($ktra)
        {
            $updatesoluongmua = $updatesoluongmua +$soluongmua;
            $sqlupdategiohang=" UPDATE giohang SET SoLuongMua ='$updatesoluongmua' where Id_Gio='$idGioUpDate' ";
            $updatesoluongcon = $soluongcon-$soluongmua;
            try{
                    if($conn->query($sqlupdategiohang))
                    {
                        if($conn->affected_rows>0)
                        {
                            foreach($Array as $sp) {
                                $ktraMaSP = $sp->getMaSP();
                                if ($masp == $ktraMaSP) { 
                                    $sp->setSoLuongMua($updatesoluongmua);
                                }
                            }
                            $_SESSION['Ds_GioHang'] = $Array;
                            $sqlupdateslsp= "UPDATE sanpham SET  SoLuong='$updatesoluongcon' where MaSP='$masp'";
                            if($conn->query($sqlupdateslsp))
                            {
                                header('Location:ChiTietSanPham.php');
                                exit();
                            }
                        }
                    }
                }catch(Exception $e)
                {
                    $tb='Thêm giỏ hàng thất bại';
                }
        }else{
                $sqlthem="INSERT INTO giohang(MaSP,SoLuongMua,DonGia,UserID) Values('$masp','$soluongmua','$dongia','$userid') ";
                    $updatesoluongcon = $soluongcon-$soluongmua;
                    try{
                        if($conn->query($sqlthem))
                        {
                            $idgiomoitao = $conn->insert_id;
                            $sanpham = New MaSanPham();
                            $sanpham->setMaSP($masp);
                            $sanpham->setIdGio($idgiomoitao);
                            $sanpham->setSoLuongMua($soluongmua);
                            $Array[]=$sanpham;
                            $_SESSION['Ds_GioHang'] = $Array;
                            $sqlupdateslsp= "UPDATE sanpham SET  SoLuong='$updatesoluongcon' where MaSP='$masp'";
                            if($conn->query($sqlupdateslsp))
                            {
                                header('Location:ChiTietSanPham.php');
                                exit();
                            }
                        }
                    }catch(Exception $e)
                    {
                        $tb='Thêm giỏ hàng thất bại';
                    }
                } 
    }else{
        header("Location:Login.php");
    }
}
if(isset($_POST['cmt']))
{
    if($_SESSION['uid']!='')
    {
        $macmt=isset($_POST['macmt']) ? $_POST['macmt']:'';
        $ndcmt=isset($_POST['ndcmt']) ? $_POST['ndcmt']:'';
        $ngaythang = date("Y-m-d");
        $manguoidung=$_SESSION['uid'];
        $sqlcmt ="INSERT INTO binhluan(MaCmtSP,UserID,NoiDung,NgayCmt) Values('$macmt','$manguoidung','$ndcmt','$ngaythang' )";
        try {
            $kqcmt=$conn->query($sqlcmt);
            $tb='Thêm thành công';
        } catch (Exception $e) {
            $tb='Thêm thất bại.Mã có thể bị trùng !!!';
        }
    }else{
        header("Location:Login.php");
    }
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
        <div class= "col-md-12">
        <div id="main-content" class="thumbnail">
        <?php
            $MaCmtSP='';
            $sqlttsp = "SELECT * FROM sanpham where MaSP='$masp'";
            $layttsp = $conn->query($sqlttsp);
            while ($row = $layttsp->fetch_assoc()) 
            {
                $tbslcon ='';
                if($row['SoLuong']===0)
                {
                    $tbslcon='Hết hàng';
                }else{
                    $tbslcon='Trong kho còn : '. $row['SoLuong'];
                }
                $MaCmtSP=$row['MaCmtSP'];
                echo "
                <div class='row'>
                    <div class='col-md-5' id='anh'>
                        <img src='" . $row['HinhAnh'] . "' alt='Product Image'>
                    </div>
                    <div class='col-md-4' id='chitiet'>
                        <p>".$tb."</p>
                        <p ><strong>Tên sản phẩm:</strong> " . $row['TenSP'] . "</p>
                        <p ><strong>Đơn giá:</strong> " . number_format($row['DonGia'])  . " VNĐ</p>
                        <p ><strong>Trạng thái:</strong> " . $tbslcon . "</p>    
                        <form method='post' class='form-inline'>
                        <input type='hidden' name='soluongcon' value='".$row['SoLuong']."'/>
                        <input type='hidden' id='dg' name='dongia' value='".$row['DonGia']."'/>
                            <div class='form-group'>
                                <label for='soluong'><strong>Số lượng mua:</strong></label>
                                <input type='number' class='form-control' name='soluongmua' value='1' min='1' max='".$row['SoLuong']."' />
                            </div>
                            <button type='submit' name='themvaogio' id='themgiohang' class='btn btn-primary'>
                                Thêm vào giỏ hàng <span class='glyphicon glyphicon-shopping-cart'></span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class='col-md-9' id='mota'><span>Mô tả:</span><p> " . $row['MoTa'] . "</p></div>
                ";  
            }
            echo "
                <div class='col-md-9' id='binhluan'>
                <form method='post'>
                <span id='commentLabel'>Bình luận :</span>
                <input type='hidden' name='macmt' value='".$MaCmtSP."'/>
                <input type='text' id='cmttext' name='ndcmt' ><input type='submit' name='cmt' id='send' value='Gửi'><br>
                </form>
                    ";
                    $sqlcmt = "SELECT * FROM binhluan WHERE MaCmtSP='$MaCmtSP' ORDER BY NgayCmt DESC";
                    $layttcmt = $conn->query($sqlcmt);
                    while ($dl = $layttcmt->fetch_assoc()) {
                        $idnguoidung = $dl['UserID'];
                        $sqllaytennguoidung = "SELECT * FROM taikhoan WHERE UserID ='$idnguoidung'";
                        $tencmt = $conn->query($sqllaytennguoidung);
                        while ($layten = $tencmt->fetch_assoc()) {
                            echo "<P>" . $layten['User'] . "</P>";
                        }
                    echo "
                            <div>
                                
                                <p>" . $dl['NoiDung'] . "</p>
                                <p>" . $dl['NgayCmt'] . "</p>
                                <hr>
                            </div>";
                    }
                    echo"</div>";
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