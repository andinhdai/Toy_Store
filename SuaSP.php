<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./Css/LeftMenu.css">
    <link rel="stylesheet" type="text/css" href="./Css/Footer.css">
    <link rel="stylesheet" type="text/css" href="./Css/Header.css">
    <link rel="stylesheet" type="text/css" href="./Css/SuaSP.css">

    <script src="./script.js"></script>
    <title>WebBanHang</title>
</head>
<body>
    <div class="container-fluid">
    <?php
        $conn =new mysqli('localhost','root','','Web_do_choi');
        $masp = '';
        if(isset($_GET['masanpham']))
        {
            $masp=$_GET['masanpham'];
        }
        $tb = '';
        if(isset($_POST['capnhat']))
        {
            $tenspsua=isset($_POST['tenspsua']) ? $_POST['tenspsua']:'';
            $dongiasua=isset($_POST['dongiasua']) ? $_POST['dongiasua']:'';
            $maloaisua=isset($_POST['maloaisua']) ? $_POST['maloaisua']:'';
            $anhsua=isset($_POST['anhsua']) ? $_POST['anhsua']:'';
            $motasua = isset($_POST['motasua']) ? $_POST['motasua'] : '';
            $soluongsua = isset($_POST['soluongsua']) ? $_POST['soluongsua'] : '';
            $chitietloaisua= isset($_POST['chitietloaisua']) ? $_POST['chitietloaisua'] : '';
            $thuonghieusua = isset($_POST['thuonghieusua']) ? $_POST['thuonghieusua'] : '';
            if($tenspsua!='' && $dongiasua!='' && $maloaisua!='' && $motasua!='' && $soluongsua!='' && $thuonghieusua!=''&& $chitietloaisua!='' )
            {
                if($anhsua!='')
                {
                    $anhsua ="./anh/". $anhsua;
                    $sql="UPDATE sanpham SET TenSP='$tenspsua', DonGia='$dongiasua' , HinhAnh='$anhsua' , MaLoai='$maloaisua' , MoTa='$motasua',SoLuong='$soluongsua',ThuongHieu='$thuonghieusua',ChiTietLoai = '$chitietloaisua' where MaSP='$masp' ";
                    if($conn->query($sql))
                    {
                        $tb='Cập nhật thông tin sản phẩm thành công !!!';
                    }
                }else{
                    $sql="UPDATE sanpham SET TenSP='$tenspsua', DonGia='$dongiasua' , MaLoai='$maloaisua' , MoTa='$motasua',SoLuong='$soluongsua',ThuongHieu='$thuonghieusua',ChiTietLoai = '$chitietloaisua' where MaSP='$masp' ";
                    if($conn->query($sql))
                    {
                        $tb='Cập nhật thông tin sản phẩm thành công !!!';
                    }
                }
            }else{
                $tb="vui lòng không để trống thông tin !!!";
            }
        }
        if(isset($_POST['xoa']))
        {
            $macmtcuasanpham=isset($_POST['mabinhluan']) ? $_POST['mabinhluan'] : '' ;
            $sql="DELETE from binhluan where MaCmtSP ='$macmtcuasanpham'";
            if($conn->query($sql))
            {
                $sql="DELETE from sanpham where MaSP='$masp'";
                if($conn->query($sql))
                {
                    header('Location:QuanLySanPham.php');
                }
            }
        }
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
        
        <!-- Nội dung chính của trang web -->
        <div id="left-menu" class="col-md-3">
            <!-- Menu bên trái -->
            <h4><a href="ThemLoaiSP.php">Thêm loại sản phẩm</a></h4>
            <!-- Danh sách các loại sản phẩm -->
            <h4><a href="ThemChiTietLoaiSP.php">Thêm nhóm của loại phản phẩm</a></h4>
        </div>
        <div id="menu-toggle" class="icon-menu col-md-1">
            <button type="button">
                <span class=" custom-glyphicon glyphicon glyphicon-th-list"></span>
            </button>
        </div>

        <div id="main-content"  class="col-md-12">
            <div class="thumbnail">
            <?php
                // $MaCmtSP='';
                $sql = "SELECT * FROM sanpham where MaSP='$masp'";
                $layttsp = $conn->query($sql);
                if($layttsp)
                {
                    $row = $layttsp->fetch_assoc();
                    $tbslcon ='';
                    $maloai=$row['MaLoai'];
                    if($row['SoLuong']===0)
                    {
                        $tbslcon='Hết hàng';
                    }else{
                        $tbslcon= $row['SoLuong'];
                    }
                    $sql="SELECT TenLoai from loaisp where MaLoai='$maloai'";
                    $laytenloai=$conn->query($sql);
                    if($laytenloai)
                    {
                        $rows=$laytenloai->fetch_assoc();
                        echo "
                        <div class='row'>
                        <form method='post' class='form-inline'>
                            <div class='col-md-5' id='anh'>
                                <img src='" . $row['HinhAnh'] . "' alt='Product Image'>
                                <br>
                                Chọn ảnh muốn thay : <input type='file' name='anhsua' >
                            </div>
                            <div class='col-md-4' id='chitiet'>
                                <p>".$tb."</p>
                                <p ><strong>Tên sản phẩm:</strong> " . $row['TenSP'] . "<br>
                                <strong>Tên sản phẩm muốn sửa:</strong><textarea name='tenspsua'  cols='50' rows='2' >" . $row['TenSP'] . "</textarea></p>
                                <p ><strong>Đơn giá:</strong> " . $row['DonGia'] . "<br>
                                <strong>Đơn giá muốn sửa:</strong><input type='number' name='dongiasua' value='" . $row['DonGia'] . "' ></p>
                                ";

                                echo"
                                <p ><strong>Loại sản phẩm:</strong> " . $rows['TenLoai'] . "<br>
                                <strong>Loại sản phẩm muốn sửa:</strong><select name='maloaisua' >
                                ";
                                    $sql="SELECT * from loaisp";
                                    $kq= $conn->query($sql);
                                    while($row3= $kq->fetch_assoc())
                                    {   
                                        if($row3['TenLoai']==$rows['TenLoai'])
                                        {
                                            echo"
                                            <option value='".$row3['MaLoai']."' selected >".$row3['TenLoai']."</option>
                                            ";
                                        }else{
                                            echo "
                                            <option value='".$row3['MaLoai']."'>".$row3['TenLoai']."</option>
                                            ";
                                        }
                                    }
                                    echo"
                            </select>
                            </p>
                                    ";

                                    echo"
                                <p ><strong>Chi tiết sản phẩm:</strong> " . $row['ChiTietLoai'] . "<br>
                                <strong>Loại sản phẩm muốn sửa:</strong><select name='chitietloaisua' >
                                ";
                                    $sql="SELECT * from chitietloai where MaLoai='$maloai'";
                                    $chitiet= $conn->query($sql);
                                    while($row3= $chitiet->fetch_assoc())
                                    {   
                                        if($row3['ChiTietLoai']==$row['ChiTietLoai'])
                                        {
                                            echo"
                                            <option value='".$row3['ChiTietLoai']."' selected >".$row3['ChiTietLoai']."</option>
                                            ";
                                        }else{
                                            echo "
                                            <option value='".$row3['ChiTietLoai']."'>".$row3['ChiTietLoai']."</option>
                                            ";
                                        }
                                    }
                                    echo"
                            </select>
                            </p>
                                    ";
                                echo"
                                <p ><strong>Số lượng trong kho :</strong> " . $tbslcon . "<br>
                                <strong>Số lượng muốn sửa :</strong><input type='number' name='soluongsua' value = '".$row['SoLuong']."' min='1'></p>  
                                <p ><strong>Thương hiệu:</strong> " . $row['ThuongHieu'] . "<br>
                                <strong>Thương hiệu muốn sửa:</strong><input type='text' name='thuonghieusua' value='" . $row['ThuongHieu'] . "' ></p>
                                <div class='col-md-9' id='mota'>
                                <span>Mô tả:</span><p> " . $row['MoTa'] . "</p>
                                <p ><strong>Mô tả muốn sửa:</strong><textarea name='motasua'  cols='40' rows='8'>" . $row['MoTa'] . "</textarea>
                                </div>
                                <input type='hidden' value='".$row['MaCmtSP']."' name='mabinhluan'>
                                <button type='submit' name='capnhat'>Cập nhật sản phẩm</button>
                                <button type='submit' name='xoa'>Xóa sản phẩm</button>
                                </form>
                                ";  
                    }
                    
                            echo"</div>";
                    }
                    //$MaCmtSP=$row['MaCmtSP'];
                    
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