<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./Css/Login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Đăng nhập</title>
</head>
<body>
<?php
    require_once 'ClassDL.php';
    session_start();
    $conn =new mysqli('localhost','root','','web_do_choi');
    $tb = '';
    $ArrayGioHang = array();
    $diachipage = $_SESSION['TrangHienTai'];
    if(isset($_POST['dn']))
    {
        $user = isset($_POST['user']) ? $_POST['user'] : '';
        $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
        if($user!=''&&$pass!='')
        {
            $ktra = false ;
            $sql = "SELECT * FROM  taikhoan ";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
                if($user==$row['User'] && $pass== $row['Pass'])
                {
                    $ktra=true;
                    $userid = $row['UserID'];
                    $_SESSION['uid'] = $userid;
                    $_SESSION['quyen'] = $row['Quyen'];
                    $sqllaymasp="SELECT MaSP , Id_Gio , SoLuongMua from giohang where UserID ='$userid' AND Id_HoaDon = 0 ";
                    $laymassp = $conn->query($sqllaymasp);
                    if ($laymassp && $laymassp->num_rows > 0)
                    {
                        while($rows=$laymassp->fetch_assoc())
                        {
                            $masptrongio = $rows['MaSP'];
                            $idtronggio = $rows['Id_Gio'];
                            $soluongmuatronggio = $rows['SoLuongMua'];
                            $masp = New MaSanPham();
                            $masp->setMaSP($masptrongio);
                            $masp->setIdGio($idtronggio);
                            $masp->setSoLuongMua($soluongmuatronggio);
                            $ArrayGioHang[]=$masp;
                        }
                    }
                }
                if($ktra)
                {
                    $_SESSION['Ds_GioHang'] = $ArrayGioHang;
                    header('Location: '.$diachipage);
                }else{
                    $tb = 'Tài khoản không tồn tại !!!';
                    echo "<script>
                            if (!window.alerted) {
                                window.alert('$tb');
                                window.alerted = true;
                            }
                        </script>";
                }
            }
        }else{
            $tb = 'Vui lòng không để trống thông tin !!!';
        }
    }
    ?>
    <div class="container">
        <form class="form-signin" action="" method="post">
            <h2 class="form-signin-heading">Đăng nhập</h2>
            <label for="inputUser" class="sr-only">User</label>
            <input type="text" id="inputUser" name="user" class="form-control" placeholder="User" required autofocus>
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="dn">Đăng nhập</button>
            <p class="text-center">Bạn chưa có tài khoản? <a href="CreatAccout.php">Đăng ký</a></p>
        </form>
    </div>
</body>
</html>