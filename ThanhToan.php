<?php
require 'header.php';
$conn=new mysqli('Localhost','root','','web_do_choi');
$tb ='';
if(isset($_POST['dathang']))
{
    $tennguoinhan= isset($_POST['tennguoinhan']) ? $_POST['tennguoinhan'] : '';
    $sdtnhan= isset($_POST['sdt']) ? $_POST['sdt'] : '';
    $diachinhan= isset($_POST['diachi']) ? $_POST['diachi'] : '';
    $ghichu= isset($_POST['ghichu']) ? $_POST['ghichu'] : '';
    $phuongthuctt= isset($_POST['phuongthuctt']) ? $_POST['phuongthuctt'] : '';
    $tongbill=$_SESSION['tongtien'];
    $ngaythang = date("Y-m-d");
    if($tennguoinhan!='' && $sdtnhan!='' && $diachinhan!='' && $ghichu!='' && $phuongthuctt!='')
    {
        $sql = "INSERT INTO hoadon(TenNguoiNhan,SdtNhan,DiaChiNhan,GhiChu,TongTien,NgayLap,PhuongThucTT) VALUES ('$tennguoinhan','$sdtnhan','$diachinhan','$ghichu','$tongbill','$ngaythang','$phuongthuctt')";
        try{
            $result = $conn->query($sql);
            $tb='Thêm thành công';
            $id_hoadon=$conn->insert_id;
            $_SESSION['Id_HoaDon'] = $id_hoadon;
            $uid=$_SESSION['uid'];
            $sql="UPDATE giohang SET Id_HoaDon='$id_hoadon' WHERE UserID='$uid' AND Id_HoaDon='0'";
            if($conn->query($sql)===TRUE)
            {
                $sosanpham= $conn->affected_rows;
                $dem=0;
                $ArraySP=array();
                $sql = "SELECT * FROM giohang where Id_HoaDon='$id_hoadon'";
                $kq=$conn->query($sql);
                while($row = $kq->fetch_assoc())
                {
                    $masp=$row['MaSP'];
                    $slmua=$row['SoLuongMua'];  
                    $sql="SELECT * FROM sanpham where MaSP='$masp'";
                    $laysp=$conn->query($sql);
                    if ($laysp->num_rows > 0) 
                    {
                        $row2 = $laysp->fetch_assoc();
                        $dongia=$row2['DonGia'];
                        $thanhtien= $dongia*$slmua;
                        $daban = $row2['DaBan']+$slmua;
                        $TTSanPham= New SanPham();
                        $TTSanPham->setTenSP($row2['TenSP']);
                        $TTSanPham->setHinhAnh($row2['HinhAnh']);
                        $TTSanPham->setThanhTien($thanhtien);
                        $ArraySP[]=$TTSanPham;
                        $sql= "UPDATE sanpham SET  DaBan='$daban'  where MaSP='$masp'";
                        if($conn->query($sql)===TRUE)
                        {
                            $dem++;
                        }
                    }
                    if($dem==$sosanpham)
                    {
                        $Ds_Moi=array();
                        $_SESSION['Ds_GioHang']=$Ds_Moi;
                        $_SESSION['DS_SP']=$ArraySP;
                        header("Location:HoaDon.php");
                    }
                }
            }
        }catch(Excption $e)
        {
            $tb='Thêm không thành công ';
        }
    }else{
            $tb='Vui lòng điền đầy đủ thông tin ';
        }
}   
?>
    <section>
        <div class="container-fluid">

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
            <div class="thumbnail">
            <form method="post" >
                <p><?php echo "$tb" ; ?></p>
                <table id="thongtintt" >
                    <tr>
                        <td>Tên người nhận:</td>
                        <td><input type="text" name="tennguoinhan" ></td>
                    </tr>
                    <tr>
                        <td>Số điện thoai:</td>
                        <td><input type="text" name="sdt"></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td><input type="text" name="diachi"></td>
                    </tr>
                    <tr>
                        <td>Ghi chú:</td>
                        <td><textarea name="ghichu"  cols="40" rows="8"></textarea>
                    </tr>
                </table>
                <hr>
                <h1>Mời bạn lựa chọn phương thức thanh toán</h1>
                <input type="radio" name="phuongthuctt" value="TienMat"> Thanh toán tiền mặt khi nhận hàng<br>
                <input type="radio" name="phuongthuctt" value="VISA"> Thanh toán online bằng thẻ Visa/Master/JCB/American Express/CUP<br>
                <input type="radio" name="phuongthuctt" value="ATM"> Thanh toán online bằng thẻ ATM nội địa và QR Code<br>
                <input type="submit" name="dathang" value="Đặt hàng" >
                </form>
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