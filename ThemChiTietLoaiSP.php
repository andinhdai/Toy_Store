<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./Css/Themchitietloai.css">
    <link rel="stylesheet" type="text/css" href="./Css/LeftMenu.css">
    <link rel="stylesheet" type="text/css" href="./Css/FooTer.css">
    <link rel="stylesheet" type="text/css" href="./Css/Header.css">
    <link rel="stylesheet" type="text/css" href="./Css/MainContent.css">

    <script src="./script.js"></script>
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
        <h1><a href="GiaoDienChinh.php">DHM Toy Kingdom</a></h1>
        <div>
    
        </div>
    </div>
    <div id="menu-toggle" class="icon-menu col-md-1">
            <button type="button">
                <span class=" custom-glyphicon glyphicon glyphicon-th-list"></span>
            </button>
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
        <div id="left-menu-them" class="col-md-3">
            <!-- Menu bên trái -->
            <h3><a href="ThemSP.php">Thêm sản phẩm</a></h3>
            <!-- Danh sách các loại sản phẩm -->
            <h3><a href="ThemLoaiSP.php">Thêm  loại sản phẩm</a></h3>
        </div>
        <div id="main-content-them" class="col-md-12">
            <div class="thumbnail">
            <?php
                $conn =new mysqli('localhost','root','','web_do_choi');
                $tb='';
                if(isset($_POST['them']))
                {
                    // $masp=isset($_POST['masp']) ? $_POST['masp']:'';
                    $maloai=isset($_POST['maloai']) ? $_POST['maloai'] : '';
                    $tennhom=isset($_POST['tennhom']) ? $_POST['tennhom']:'';
                    if($maloai!='' && $tennhom!='')
                    {
                        $sql = "INSERT INTO chitietloai(MaLoai,ChiTietLoai)  VALUES ('$maloai','$tennhom')";
                        try {
                            $result = $conn->query($sql);
                            $tb='Thêm thành công !!';
                        } catch (Exception $e) {
                            $tb='Thêm thất bại. Có thể tên nhóm đã tồn tại !!!';
                        }
                    }else{
                        $tb='Vui lòng không để trống thông tin';
                    }
                }
            ?>
            
            <form id="formthem" action="" method="post">
                <table>
                    <caption><h3>THÊM LOẠI SẢN PHẨM MỚI </h3></caption>
                    <tr>
                        <td colspan="2"><label><?php echo $tb ?></label></td>
                    </tr>
                    <tr>
                        <td>Tên loại : </td>
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
                        <td>Tên nhóm muốn thêm : </td>
                        <td><input type="text" name="tennhom" id=""></td>
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
    
    <div class="footer">
    <p>Họ Tên : An Đình Đại - Ngày sinh: 28/3/2002</p>
<p>Họ Tên : Đỗ Minh Hiếu - Ngày sinh: 21/4/2002</p>
<p>Họ Tên : Lê Quang Minh - Ngày sinh: 03/8/2002</p>

        </div>
    </div>
</body>
</html>