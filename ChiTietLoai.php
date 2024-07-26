<?php
require 'header.php';
$conn =new mysqli('localhost','root','','web_do_choi');
$tb='';
$masp='';
$maloai='';
if(isset($_GET['masp']) && isset($_GET['maloai']))
{
    $masp=$_GET['masp'];
    $maloai=$_GET['maloai'];
}
                
if(isset($_POST['acp']))
{
$chitietloai=isset($_POST['chitietloai']) ? $_POST['chitietloai']:'';
if($chitietloai!='')
{
$sql = "UPDATE sanpham SET ChiTietLoai ='$chitietloai' where MaSP='$masp' ";
try {
       $result = $conn->query($sql);
       header("Location:ThemSP.php");
    } catch (Exception $e) {
     $tb='Thêm thất bại !!!';
    }
 }else{
     $tb='Vui lòng chọn thông tin';
      }
}
?>
    <section>
        <!-- Nội dung chính của trang web -->
        <div id="left-menu" class="col-md-3">
            <h3><a href="GiaoDienChinh">Trang chủ</a></h3>
        </div>
        <div id="main-content" class="col-md-12">
            <form action="" method="post" id="frm_chitiet">
                <table>
                    <caption>Phân nhóm cho loại sản phẩm</caption>
                    <tr>
                        <td colspan="2"><label><?php echo $tb ?></label></td>
                    </tr>
                    
                    <tr>
                        <td>Vui lòng chọn nhóm cho loại sản phẩm  : </td>
                        <td>
                            
                            <?php
                                $sql="SELECT * from chitietloai where MaLoai='$maloai'";
                                $kq= $conn->query($sql);
                                while($row= $kq->fetch_assoc())
                                {
                                    $tenloai=$row['ChiTietLoai'];
                                    echo "
                                    <input type='radio' id='chon' name='chitietloai' value='".$tenloai."' >".$tenloai."<br>
                                    ";
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Xác nhận" name="acp"></td>
                    </tr>
                </table>
                <!-- <input type="file" name="" id=""> -->
            </form>
        
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