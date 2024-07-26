<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./Css/MainContent.css">
    <!-- <link rel="stylesheet" type="text/css" href="./Css/LeftMenu.css"> -->
    <link rel="stylesheet" type="text/css" href="./Css/newleftmenu.css">
    <link rel="stylesheet" type="text/css" href="./Css/FooTer.css">
    <link rel="stylesheet" type="text/css" href="./Css/Header.css">
    <link rel="stylesheet" type="text/css" href="./Css/Hoadon.css">
    <link rel="stylesheet" type="text/css" href="./Css/Contentchitietsp.css">
    <link rel="stylesheet" type="text/css" href="./Css/Giohang.css">
    <link rel="stylesheet" type="text/css" href="./Css/Phanhoi.css">
    <link rel="stylesheet" type="text/css" href="./Css/Nav.css">
    <script src="./newscript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>WebBanHang</title>
</head>
<body>
    <div class="container-fluid">
    <?php
        require_once 'ClassDL.php';
        session_start();
        $ndtk='';
        if(isset($_GET['ndtk']) )
        {
            $ndtk = $_GET['ndtk'];
        }
        $_SESSION['ndtk'] = '';
        $tranghientai = basename($_SERVER['SCRIPT_FILENAME']);
        $_SESSION['TrangHienTai']=$tranghientai;
        if (!isset($_SESSION['uid'])) {
            $_SESSION['uid'] = "";
        }
        if (isset($_POST['log'])) {
                $_SESSION['quyen'] = 0;
                unset($_SESSION['uid']);
                header("Location: GiaoDienChinh.php");
        }
        if (isset($_POST['tk'])) {
            $ndtk = isset($_POST['noidungtk']) ? $_POST['noidungtk'] : '';
            if($ndtk!='')
            {
                header("Location: TimKiem.php?ndtk=".$ndtk."");
            }
            
        }
    ?>
    <div class="container-fluid text-center" id="header-css">
        <h1><a href="GiaoDienChinh.php">DHM Toy Kingdom </a></h1>
    </div>
    <div>
        <nav id="nav-css" class="navbar navbar-default">
            <div  class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#abc">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="abc">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="Giaodienchinh.php">Trang chủ</a></li>
                        <li><a href="TimKiem.php">Tìm kiếm sản phẩm</a></li>
                        <?php
                        if (!isset($_SESSION['quyen'])) {
                            $_SESSION['quyen'] = 0;
                        }
                        if ($_SESSION['quyen'] == 0) {
                            echo "<li><a href='Login.php'>Giỏ hàng</a></li>";
                        }
                        if ($_SESSION['quyen'] == 1) {
                            echo "<li><a href='GioHang.php'>Giỏ hàng</a></li>";
                            echo "<li><a href='PhanHoi.php'>Phản Hồi</a></li>";
                        }
                        if ($_SESSION['quyen'] == 2) {
                            echo "<li><a href='GioHang.php'>Giỏ hàng</a></li>";
                            echo "<li><a href='PhanHoi.php'>Phản Hồi</a></li>";
                            echo "<li><a href='QuanLySanPham.php'>Quản lý sản phẩm</a></li>";
                        }
                        ?>
                        <li><a href="SanPhamBanNhieu.php">Sản phẩm bán nhiều</a></li>
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
                            echo "<li><a id = 'linkdangnhap' href='Login.php'><span class='glyphicon glyphicon-log-in'></span> Đăng nhập</a></li>";
                        } else {
                            echo "<li><span class='glyphicon glyphicon-log-in' style='margin-top: 15px;'></span></li>";
                            echo "<li ><form method='post'><span>&nbsp;</span><button id='logout' type='submit' name='log' >Đăng xuất</button></form></li>";
                        }
                        ?>
                    </ul>
                    
                </div>
                </div>
            </div>
        </nav>
    </div>
    <div id="menu-toggle" class="icon-menu col-md-1">
            <button type="button">
                <span class=" custom-glyphicon glyphicon glyphicon-th-list"></span>
            </button>
        </div>
