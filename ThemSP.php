<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./Css/MainContent.css">
    <link rel="stylesheet" type="text/css" href="./Css/newleftmenu.css">
    <link rel="stylesheet" type="text/css" href="./Css/FooTer.css">
    <link rel="stylesheet" type="text/css" href="./Css/Header.css">
    <link rel="stylesheet" type="text/css" href="./Css/ThemSP.css">
    <script src="./newscript.js"></script>
    <title>WebBanHang</title>
</head>
<body>
    <div class="container-fluid">
    <?php
        require_once 'ClassDL.php';
        $btndangnhap = '';
        session_start();
        $_SESSION['ndtk'] = '';
        if (!isset($_SESSION['uid'])) {
            $_SESSION['uid'] = "";
        }
        if ($_SESSION['uid'] == "") {
            $btndangnhap = 'Đăng nhập';
        } else {
            $btndangnhap = 'Đăng xuất';
        }
        $hienthi = $_SESSION['uid'];
        if (isset($_POST['log'])) {
            if ($btndangnhap == 'Đăng nhập') {
                header("Location: Login.php");
            }
            if ($btndangnhap == 'Đăng xuất') {
                $_SESSION['quyen'] = 0;
                unset($_SESSION['uid']);
                header("Location: GiaoDienChinh.php");
            }
        }
    ?>
    <div class="container-fluid text-center" id="header-css">
        <h1><a href="QuanLySanPham.php">Trang quản lý</a></h1>
        <div>
    
        </div>
    </div>
    <nav id="nav-css" class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#abc">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="#">Logo</a> -->
                </div>
                <div class="collapse navbar-collapse" id="abc">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="Giaodienchinh.php">Trang chủ</a></li>
                        <li><a href="ThemSP.php">Thêm sản phẩm</a></li>
                        <li><a href="QuanLySanPham.php">Sửa sản phẩm</a></li>
                        <!-- <li><a href="#">Xóa sản phẩm</a></li> -->
                        <li><a href="ThongKe.php">Thống kê</a></li>
                       
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if ($_SESSION['uid'] == "") {
                            echo "<li><a href='CreatAccout.php'><span class='glyphicon glyphicon-user'></span> Đăng kí</a></li>";
                            echo "<li><a href='Login.php'><span class='glyphicon glyphicon-log-in'></span> Đăng nhập</a></li>";
                        } else {
                            echo "<li><span class='glyphicon glyphicon-log-in' style='margin-top: 13px;'></span></li>";
                            echo "<li><form method='post'><span>&nbsp;</span><button type='submit' name='log' style='margin-top: 10px;'>Đăng xuất</button></form></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    <section>
    <div id="menu-toggle" class="icon-menu col-md-1">
            <button type="button">
                <span class=" custom-glyphicon glyphicon glyphicon-th-list"></span>
            </button>
        </div>
        <!-- Nội dung chính của trang web -->
        <div id="left-menu" class="col-md-3">
            <!-- Menu bên trái -->
            <h4><a href="ThemLoaiSP.php">Thêm loại sản phẩm</a></h4>
            <!-- Danh sách các loại sản phẩm -->
            <h4><a href="ThemChiTietLoaiSP.php">Thêm nhóm của loại sản phẩm</a></h4>
        </div>
        <div id="main-content-themsp"  class="col-md-12">
            <div class="thumbnail">
            <?php
                $conn =new mysqli('localhost','root','','web_do_choi');
                $tb='';
                if(isset($_POST['them']))
                {
                    // $masp=isset($_POST['masp']) ? $_POST['masp']:'';
                    $tensp=isset($_POST['tensp']) ? $_POST['tensp']:'';
                    $dongia=isset($_POST['dongia']) ? $_POST['dongia']:'';
                    $maloai=isset($_POST['maloai']) ? $_POST['maloai']:'';
                    $anh=isset($_POST['anh']) ? $_POST['anh']:'';
                    $mota = isset($_POST['mota']) ? $_POST['mota'] : '';
                    $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : '';
                    $thuonghieu = isset($_POST['thuonghieu']) ? $_POST['thuonghieu'] : '';
                    $sql="SELECT SUBSTRING(MaSP,3) AS MaSo FROM sanpham ORDER BY MaSP DESC LIMIT 1";
                    $layso=$conn->query($sql);
                    if($layso->num_rows > 0)
                    {
                        $row = $layso->fetch_assoc();
                        $kq=$row['MaSo'];
                        $kqthem1= $kq+1;
                        $kqso = str_pad($kqthem1, 2, '0', STR_PAD_LEFT);
                    }else{
                        $kq=0;
                        $kqthem1= $kq+1;
                        $kqso = str_pad($kqthem1, 2, '0', STR_PAD_LEFT);
                    }
                    $masp="SP".$kqso;
                    // $formattedNumber = str_pad($number, 2, '0', STR_PAD_LEFT);

                    if($masp!='' && $tensp!='' && $dongia!='' && $maloai!='' && $anh!='' && $mota!='' && $soluong!='' && $thuonghieu!='')
                    {
                        $anh ="./anh/". $anh;
                        $macmtsp = "Cmt_". $masp;
                        $chitietloai='Khác';
                        $sql = "INSERT INTO sanpham(MaSP,TenSP,DonGia,HinhAnh,MaLoai,MoTa,SoLuong,DaBan,ThuongHieu,MaCmtSP,ChiTietLoai)  VALUES ('$masp','$tensp','$dongia','$anh','$maloai','$mota','$soluong','0','$thuonghieu','$macmtsp','$chitietloai')";
                        try {
                            $result = $conn->query($sql);
                            header("Location:ChiTietLoai.php?masp=".$masp."&maloai=".$maloai."");

                        } catch (Exception $e) {
                            $tb='Thêm thất bại.Mã có thể bị trùng !!!';
                        }
                    }else{
                        $tb='Vui lòng không để trống thông tin';
                    }
                }
            ?>
            
            <form action="" method="post">
                <table>
                    <caption>Nhập thông tin sản phẩm</caption>
                    <tr>
                        <td colspan="2"><label><?php echo $tb ?></label></td>
                    </tr>
                    <!-- <tr>
                        <td>Mã sản phẩm : </td>
                        <td><input type="text" name="masp" ></td>
                    </tr> -->
                    <tr>
                        <td>Tên sản phẩm : </td>
                        <td><textarea name="tensp"  cols="50" rows="2"></textarea></td>
                        <!-- <td><input type="text" name="tensp" id=""></td> -->
                    </tr>
                    <tr>
                        <td>Đơn giá : </td>
                        <td><input type="number" name="dongia" id=""></td>
                    </tr>
                    <tr>
                        <td>Mã loại : </td>
                        <td>
                            <select name="maloai" id="">
                                <?php
                                    $sql="SELECT * from loaisp";
                                    $kq= $conn->query($sql);
                                    while($row= $kq->fetch_assoc())
                                    {
                                        echo "
                                        <option value='".$row['MaLoai']."'>".$row['TenLoai']."</option>
                                        ";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ảnh : </td>
                        <td><input type="file" name="anh" id=""></td>
                    </tr>
                    <tr>
                        <td>Mô tả : </td>
                        <td><textarea name="mota"  cols="40" rows="8"></textarea></td>
                    </tr>
                    <tr>
                        <td>Số lượng : </td>
                        <td><input type="number" name="soluong" value = "5" min="5" id=""></td>
                    </tr>
                    <tr>
                        <td>Thương hiệu : </td>
                        <td><input type="text" name="thuonghieu" id=""></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Thêm" name="them"></td>
                        <td><input type="reset" value="Reset"></td>
                    </tr>
                </table>
                <!-- <input type="file" name="" id=""> -->
            </form>
                    </div>
        </div>
    </section>
    
    <div class="footer" >
        <p>Họ Tên : An Đình Đại - Ngày sinh: 28/3/2002</p>
<p>Họ Tên : Đỗ Minh Hiếu - Ngày sinh: 21/4/2002</p>
<p>Họ Tên : Lê Quang Minh - Ngày sinh: 03/8/2002</p>
    </div>

   </div>
</body>
</html>