<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="Login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Đăng ký</title>
</head>
<body>
<?php
    $tb = '';
    if(isset($_POST['cr']))
    {
        $conn =new mysqli('localhost','root','','web_do_choi');
        $hoten = isset($_POST['hoten']) ? $_POST['hoten'] : '';
        $user = isset($_POST['user']) ? $_POST['user'] : '';
        $email = isset($_POST['diachiemail']) ? $_POST['diachiemail'] : '';
        $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : '';
        $diachi = isset($_POST['diachi']) ? $_POST['diachi'] : '';
        $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
        $confirmpass = isset($_POST['confirmpass']) ? $_POST['confirmpass'] : '';
        if($hoten!=''&& $user!=''&& $email!='' &&$sdt!=''&&$diachi!='' &&$pass!='' &&$confirmpass!='')
        {
            if($pass==$confirmpass)
            {
                $ktra = false ;
                $sql = "INSERT INTO khachhang(HoTen,Email,Sdt,DiaChi) Values('$hoten','$email','$sdt','$diachi') ";
                
                try{
                    if($conn->query($sql))
                    {
                        $makh = $conn->insert_id;
                        $sql = "INSERT INTO taikhoan(User,Pass,MaKH,Quyen) Values('$user','$pass','$makh',1) ";
                        if($conn->query($sql))
                        {
                            header("Location:Login.php");
                            $tb='Đăng ký thành công !!!';
                        }
                    }
                }catch(Exception $e)
                {
                    $tb='Tên đăng nhập đã tồn tại !!!';
                }
                
            }else{
                $tb='Vui lòng nhập mật khẩu giống nhau!!';
                
            }
            
        }else{
            $tb = 'Vui lòng không để trống thông tin !!!';
        }
    }
    ?>
    <div class="container">
        <form class="form-signin" action="" method="post">
            <h2 class="form-signin-heading">Đăng ký tài khoản</h2>
            <label for="inputName" class="sr-only">Họ Tên</label>
            <input type="text" id="inputName" name="hoten" class="form-control" placeholder="Họ Tên" required autofocus>
            <label for="inputUser" class="sr-only">Tên đăng nhập</label>
            <input type="text" id="inputUser" name="user" class="form-control" placeholder="Tên đăng nhập" required>
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" name="diachiemail" class="form-control" placeholder="Email" required>
            <label for="inputPhone" class="sr-only">Số điện thoại</label>
            <input type="tel" id="inputPhone" name="sdt" class="form-control" placeholder="Số điện thoại" pattern="[0-9]{10}" required>
            <label for="inputAddress" class="sr-only">Địa chỉ</label>
            <input type="text" id="inputAddress" name="diachi" class="form-control" placeholder="Địa chỉ" required>
            <label for="inputPassword" class="sr-only">Mật khẩu</label>
            <input type="password" id="inputPassword" name="pass" class="form-control" maxlength="16" minlength="8" placeholder="Mật khẩu" required>
            <label for="inputConfirmPassword" class="sr-only">Nhập lại mật khẩu</label>
            <input type="password" id="inputConfirmPassword" name="confirmpass" class="form-control" placeholder="Nhập lại mật khẩu" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="cr">Đăng ký</button>
            <button class="btn btn-lg btn-default btn-block" type="reset" name="rs">Reset</button>
        </form>
    </div>
</body>
</html>
