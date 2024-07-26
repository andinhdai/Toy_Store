<?php
require 'header.php';
?>

    <section>
        <!-- Nội dung chính của trang web -->
        <div id="left-menu" class="col-md-3">
<div id="left-menu" class="col-md-3">
            <!-- Menu bên trái -->
            <h4><a style="color: white" href="Giaodienchinh.php">Trang chủ</a></h4>
            <!-- Danh sách các loại sản phẩm -->
            
        </div>    
        </div>
        <div id="maincontent-phanhoi" class="col-md-12">
            <?php
                $conn = new mysqli('localhost','root','','web_do_choi');
                $tb='';
                if(isset($_POST['phanhoi']))
                {
                    $ndphanhoi = isset($_POST['ndphanhoi']) ? $_POST['ndphanhoi'] : '';
                    if($ndphanhoi!='')
                    {
                        $ngaythang = date("Y-m-d");
                        $UserId = $_SESSION['uid'];
                        $sql="INSERT INTO phanhoi(UserID,NoiDung,NgayGui) VaLUES('$UserId','$ndphanhoi','$ngaythang')";
                        if($conn->query($sql))
                        {
                            $tb='Gửi phản hồi thành công !! Cảm ơn ý kiến đóng góp của bạn của bạn !!';
                        }else{
                            $tb='Gửi phản hồi thất bại !!!';
                        }
                    }else{
                        $tb='Vui lòng không để trống nội dung!!!';
                    }
                }
            ?>
            <form action="" method="post">
                <table>
                    <caption>PHIẾU PHẢN HỒI</caption>
                    <tr>
                        <td colsan="2"><?php echo "$tb"; ?></td>
                    </tr>
                    <tr>
                        <td>Nội dung phản hồi : </td>
                        <td><textarea name="ndphanhoi"  cols="40" rows="8"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Gửi" name="phanhoi"> <input type="reset" value="Reset"></td>
                    </tr>
                </table>
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