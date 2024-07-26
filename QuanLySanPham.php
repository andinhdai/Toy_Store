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
    <link rel="stylesheet" type="text/css" href="./Css/Maincontent.css">
    <link rel="stylesheet" type="text/css" href="./Css/newleftmenu.css">
    <link rel="stylesheet" type="text/css" href="./Css/Footer.css">
    <link rel="stylesheet" type="text/css" href="./Css/Header.css">
    <link rel="stylesheet" type="text/css" href="./Css/Login.css">
    <script src="./newscript.js"></script>
    <title>WebBanHang</title>
</head>
<body>
    <div class="container-fluid">
    <?php
        require_once 'ClassDL.php';
        $conn = new mysqli('localhost', 'root', '', 'Web_do_choi');
        if (isset($_POST['sua'])) {
            $masp = isset($_POST['masp']) ? $_POST['masp'] : '';
            //$_SESSION['maspcansua'] = $masp;
            header('Location:SuaSP.php?masanpham='.$masp);
        }
        $btndangnhap = '';
        session_start();
        $ndtk='';
        if(isset($_GET['ndtk']))
        {
            $ndtk = $_GET['ndtk']; 
        }
        $sortloaisp='';
        if(isset($_GET['loaisp']))
        {
            $sortloaisp=$_GET['loaisp'];
        }
        $sortchitietloaisp='';
        if(isset($_GET['chitietloaisp']))
        {
            $sortchitietloaisp=$_GET['chitietloaisp'];
        }
        $sortsoluong='';
        if(isset($_GET['soluong']))
        {
            $sortsoluong=$_GET['soluong'];
        }
        // $_SESSION['ndtk'] = '';
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
        <h1><a href="GiaoDienChinh.php">Trang quản lý</a></h1>
        <div>
            
            <?php
                if (isset($_POST['tk'])) {
                    // $_SESSION['ndtk'] = isset($_POST['tk']) ? $_POST['tk'] : '';
                    $tttk=isset($_POST['noidungtk']) ? $_POST['noidungtk'] : '';
                    header('Location: QuanLySanPham.php?ndtk='.$tttk);
                }
                $ndtk = isset($ndtk) ? $ndtk : '';
            ?>
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
                        <li>
                            <form class="navbar-form navbar-left" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="noidungtk" value="<?php echo"$ndtk"; ?>" placeholder="Mời nhập tên sản phẩm">
                                </div>
                                <button type="submit" name="tk" class="btn btn-default" >
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </form>
                        </li>
                        <?php
                        if ($_SESSION['uid'] == "") {
                            echo "<li><a href='CreatAccout.php'><span class='glyphicon glyphicon-user'></span> Đăng kí</a></li>";
                            echo "<li><a href='Login.php'><span class='glyphicon glyphicon-log-in'></span> Đăng nhập</a></li>";
                        } else {
                            echo "<li><span class='glyphicon glyphicon-log-in' style='margin-top: 15px;'></span></li>";
                            echo "<li ><form method='post'><span>&nbsp;</span><button id='logout' type='submit' name='log' >Đăng xuất</button></form></li>";
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
                                <a href='QuanLySanPham.php?loaisp=".$maloai."' class='submenu-item'>".$loaisp['TenLoai']."<span class='glyphicon glyphicon-chevron-down'></span></a>
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
                                        <li class='submenu-item'><a href='QuanLySanPham.php?loaisp=".$maloai."& chitietloaisp=".$tenchitiet."'>".$tenchitiet."</a></li>
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
                <li class='menu-item'>
                    <a href="QuanLySanPham.php?soluong=true" class="submenu-item">Sản phẩm còn ít<span class="glyphicon glyphicon-chevron-down"></span></a>
                    <!-- <ul class="submenu">
                           <li class="submenu-item"><a href="3">Alo</a></li>
                    </ul> -->
                </li>
            </ul>
            <!-- <ul class="menu">
            
            </ul> -->
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
        if($ndtk==''&&$sortloaisp==''&&$sortchitietloaisp==''&&$sortsoluong=='')
        {
            $sql = "SELECT * FROM sanpham LIMIT $vitribanghibatdau, $sobanghi1trang";
        }else{
            if($sortloaisp!='')
            {
                if($sortchitietloaisp!='')
                {
                    $sql = "SELECT * FROM sanpham where MaLoai='$sortloaisp' AND ChiTietLoai='$sortchitietloaisp' LIMIT $vitribanghibatdau, $sobanghi1trang";
                }else{
                    $sql = "SELECT * FROM sanpham where MaLoai='$sortloaisp' LIMIT $vitribanghibatdau, $sobanghi1trang";
                }
            }elseif($ndtk!='')
            {
                $sql="SELECT * FROM sanpham Where LOWER(TenSP) LIKE LOWER('%$ndtk%') LIMIT $vitribanghibatdau , $sobanghi1trang ";
            }else{
                $sql="SELECT * FROM sanpham order by SoLuong  LIMIT $vitribanghibatdau , $sobanghi1trang ";
            }
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
                                    <button type='submit' name='sua' class='btn btn-primary'>Sửa</button>
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
        if($ndtk==''&&$sortloaisp==''&&$sortchitietloaisp==''&&$sortsoluong=='')
        {
            $sql = "SELECT Count(*) AS soluongsp From sanpham";
        }else{
            if($sortloaisp!='')
            {
                if($sortchitietloaisp!='')
                {
                    $sql = "SELECT Count(*) AS soluongsp From sanpham where MaLoai='$sortloaisp' AND ChiTietLoai='$sortchitietloaisp'";
                }else{
                    $sql = "SELECT Count(*) AS soluongsp From sanpham where MaLoai='$sortloaisp'";
                }
            }elseif($ndtk!='')
            {
                $sql="SELECT Count(*) AS soluongsp From sanpham Where LOWER(TenSP) LIKE LOWER('%$ndtk%')";
            }else{
                $sql="SELECT Count(*) AS soluongsp From sanpham order by SoLuong";
            }
        }
        $kq = $conn->query($sql);
        $row = $kq->fetch_assoc();
        $soluongsp = $row['soluongsp'];
        $sotrang = ceil($soluongsp / $sobanghi1trang);
        if($ndtk==''&&$sortloaisp==''&&$sortchitietloaisp==''&&$sortsoluong=='')
        {
            for ($i = 1; $i <= $sotrang; $i++) {
                echo "<a href='QuanLySanPham.php?page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
            }
        }else{
            if($sortloaisp!='')
            {
                if($sortchitietloaisp!='')
                {
                    for ($i = 1; $i <= $sotrang; $i++) {
                        echo "<a href='QuanLySanPham.php?loaisp=".$sortloaisp."&chitietloaisp=".$sortchitietloaisp."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                    }
                }else{
                    for ($i = 1; $i <= $sotrang; $i++) {
                        echo "<a href='QuanLySanPham.php?loaisp=".$sortloaisp."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                    }
                }
            }elseif($ndtk!='')
            {
                for ($i = 1; $i <= $sotrang; $i++) {
                    echo "<a href='QuanLySanPham.php?ndtk=".$ndtk."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                }
            }else{
                for ($i = 1; $i <= $sotrang; $i++) {
                    echo "<a href='QuanLySanPham.php?soluong=".$sortsoluong."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                }
            }
        }
        ?>
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