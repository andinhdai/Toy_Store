<?php
// ob_start();
require 'header.php'; 
$conn = new mysqli('localhost','root','','Web_do_choi');
$UserID=$_SESSION['uid'];
$Array = array();
$Array = $_SESSION['Ds_GioHang'];
if(isset($_POST['thanhtoan']))
       {
         $tongbill= isset($_POST['tongtien']) ? $_POST['tongtien'] : '';
         $_SESSION['tongtien']=$tongbill;
         header("Location:ThanhToan.php");
       }   
if(isset($_POST['capnhat']))
{
    $idsp=isset($_POST['idxoa']) ? $_POST['idxoa']:'';
    $maspxoa=isset($_POST['maspxoa']) ? $_POST['maspxoa']:'';
    $slspxoa=isset($_POST['sospxoa']) ? $_POST['sospxoa']:'';
    $slspcon =isset($_POST['slcon']) ? $_POST['slcon']:'';
    $slcapnhat =isset($_POST['soluongmua']) ? $_POST['soluongmua']:'';
    if($slcapnhat!=$slspxoa)
    {
        $slspcon=$slspcon+$slspxoa-$slcapnhat;
        $sqlcapnhat="UPDATE giohang Set SoLuongMua = '$slcapnhat' WHERE Id_Gio='$idsp'";
        $capnhat=$conn->query($sqlcapnhat);
        if($capnhat)
        {
            $sqlupdatesl = "UPDATE sanpham SET  SoLuong='$slspcon' where MaSP='$maspxoa'";
            if($conn->query($sqlupdatesl))
            {
                foreach($Array as $key => $sp) {
                    $ktraIdGio = $sp->getIdGio();
                    if ($idsp == $ktraIdGio) {
                        $sp->setSoLuongMua($sqlcapnhat);
                    }
                }
                $_SESSION['Ds_GioHang'] = $Array;
                header('Location: GioHang.php');
            }   
        }
    }
} 
if(isset($_POST['xoa']))
{
    $idsp=isset($_POST['idxoa']) ? $_POST['idxoa']:'';
    $maspxoa=isset($_POST['maspxoa']) ? $_POST['maspxoa']:'';
    $slspxoa=isset($_POST['sospxoa']) ? $_POST['sospxoa']:'';
    $slspcon =isset($_POST['slcon']) ? $_POST['slcon']:'';
    $xoa="DELETE FROM GioHang WHERE Id_Gio='$idsp'";
    $kqxoa=$conn->query($xoa);
    if($kqxoa)
    {
        $slspcon=$slspcon+$slspxoa;
        $sqlupdatesl = "UPDATE sanpham SET  SoLuong='$slspcon' where MaSP='$maspxoa'";
        if($conn->query($sqlupdatesl))
        {
            foreach($Array as $key => $sp) {
                $ktraIdGio = $sp->getIdGio();
                if ($idsp == $ktraIdGio) {
                    unset($Array[$key]);
                }
            }
            $_SESSION['Ds_GioHang'] = $Array;
            header('Location: GioHang.php');
        }   
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
        <div id="main-content" class="col-md-12">
            <div class="thumbnail">
                <div id="oder">
                    <div>
                        <table >
                            <tr>
                                <th style="width: 40px;
                                            height: auto;">STT</th>
                                <th style="width: 300px;
                                            height: auto;">Tên sản phẩm</th>
                                <th style="width: 300px;
                                            height: auto;">Hình ảnh</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Cập nhật</th>
                                <th>Xóa</th>
                            </tr>
                            <?php
                                
                                $sql ="SELECT * FROM GioHang Where UserID='$UserID' AND Id_HoaDon=0 ";
                                $result = $conn->query($sql);
                                $dem=0;
                                $thanhtien=0;
                                $tongtien=0;
                                while($row = $result->fetch_assoc())
                                {
                                    $thanhtien=$row['DonGia']*$row['SoLuongMua'];
                                    $dem=$dem+1;
                                    $masp=$row['MaSP'];
                                    $ttsp="SELECT * FROM sanpham WHERE MaSP='$masp'";
                                    $ifsp=$conn->query($ttsp);
                                    while($rows= $ifsp->fetch_assoc())
                                    {
                                        echo "
                                        <form method='post'>
                                    <tr>
                                        <td >".$dem."
                                        <input type='hidden' name='idxoa' value='".$row['Id_Gio']."' >
                                        <input type='hidden' name='maspxoa' value='".$row['MaSP']."' >
                                        <input type='hidden' name='sospxoa' value='".$row['SoLuongMua']."'>
                                        <input type='hidden' name='slcon' value='".$rows['SoLuong']."'>
                                                </td>
                                        <td style='width: 300px;
                                                height: auto;'>".$rows['TenSP']."</td>
                                        <td style='width: 300px;
                                                height: auto;'><img style='width:100px; height: 100px; ' <img src='".$rows['HinhAnh']."'></td>
                                        <td>".$row['DonGia']."</td>
                                        <td><input type='number' name='soluongmua' value='".$row['SoLuongMua']."' min='1' max='".$rows['SoLuong']."' /></td>
                                        <td>".$thanhtien."</td>
                                        <td><button type='submit' name='capnhat' id='capnhat'>Cập nhật</button></td>
                                        <td><button type='submit' name='xoa' id='xoa'>Xóa</button></td>
                                    </tr>
                                    </form>
                                    ";
                                    $tongtien=$tongtien+$thanhtien;
                                    }
                                }
                                    echo "
                                    <tr>
                                        <th style='width: 40px;
                                                height: auto;'>&nbsp;</th>
                                        <th style='width: 300px;
                                                height: auto;'>Tổng tiền:</th>
                                        <th style='width: 300px;
                                                height: auto;'>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>".$tongtien."</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    ";
                            ?>
                        </table>
                    </div>
                        </div>
                        <div >
                        <br>
                        <br>
                        <hr size="2px" width="95%" >
                        <br>
                        <br>
                        </div>
                        <div id="dathang">
                        <?php
                            if($tongtien!=0)
                            {
                                echo "
                                    <form method='post' >
                                    <input type='text' name='tongtien' value='".$tongtien."' hidden='true' >
                                    <input type='submit' name='thanhtoan' value='Tiến Hành Thanh Toán' id='chotdon'>
                                    </form>
                                    "; 
                                    }else
                                    {
                                    echo"
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <p style='font-size:25px;color:red;'>Bạn chưa lựa chọn sản phẩm nào , vui lòng quay lại trang chủ để lựa chọn sản phẩm !!!</p>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                ";
                            }
                        ?>
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