<?php
require 'header.php';
$conn =new mysqli('localhost','root','','web_do_choi');
if(isset($_POST['mua']))
{
    $masp= isset($_POST['masp']) ? $_POST['masp'] : '';
    $_SESSION['machitietsp']=$masp;
    header("Location:ChiTietSanPham.php");
}
// $ktra=false;
// if(isset($_GET['sapxep']))
$urlsort = $_SERVER['REQUEST_URI'];
$thuonghieuhientai='';
$dongiahientai='';
if(isset($_GET['thuonghieu']))
{
    $thuonghieuhientai=$_GET['thuonghieu'];
}
if(isset($_GET['dongia']))
{
    $dongiahientai=$_GET['dongia'];
}
$sapxeptheogia='';
if(isset($_GET['sapxep']))
{
    $sapxeptheogia=$_GET['sapxep'];
}
?>
    <section>
    <div id="left-menu" class="col-md-3">
        <ul class="menu">
            <li class="menu-item">
                <?php
                    if($sapxeptheogia!='')
                    {
                        // $urlsort = $_SERVER['REQUEST_URI'];
                        $giatrisorthientai='TimKiem.php?sapxep='.$sapxeptheogia;
                        $giatrisortmoi='';
                        if($sapxeptheogia=='ASC')
                        {
                            $giatrisortmoi = 'TimKiem.php?sapxep=DESC';
                            // $giatrisortmoi = str_replace('ASC','DESC',$urlsort);
                        }else{
                            $giatrisortmoi = 'TimKiem.php?sapxep=DESC';
                            // $giatrisortmoi = str_replace('DESC','ASC',$urlsort);
                        }
                        echo"
                            <a href='".$giatrisortmoi."' class='submenu-item'>Tìm kiếm theo giá tiền <span class='glyphicon glyphicon-chevron-down'></span></a>
                            <ul class='submenu'>
                                <li class='submenu-item'><a href='".$giatrisorthientai."&dongia=<100000'>100.000VND trở xuống</a></li>
                                <li class='submenu-item'><a href='".$giatrisorthientai."&dongia=100000-300000'>100.000VND-300.000VND</a></li>
                                <li class='submenu-item'><a href='".$giatrisorthientai."&dongia=300000-500000'>300.000VND-500.000VND</a></li>
                                <li class='submenu-item'><a href='".$giatrisorthientai."&dongia=500000-700000'>500.000VND-700.000VND</a></li>
                                <li class='submenu-item'><a href='".$giatrisorthientai."&dongia=700000-1000000'>700.000VND-1.000.000VND</a></li>
                                <li class='submenu-item'><a href='".$giatrisorthientai."&dongia=>1000000'>1.000.000VND trở lên</a></li>
                            </ul>
                        ";
                        echo "
                            </li>
                            <li class='menu-item'>
                                <h3 class='submenu-item'>Tìm kiếm theo thương hiệu <span class='glyphicon glyphicon-chevron-down'></span></h3>
                                <ul class='submenu'>
                        ";
                                    $sqlthuonghieu="SELECT DISTINCT ThuongHieu from sanpham";
                                    $laythuonghieu=$conn->query($sqlthuonghieu);
                                    if($laythuonghieu)
                                    {
                                        while($tenth=$laythuonghieu->fetch_assoc())
                                        {
                                            echo"
                                                <li class='submenu-item'><a href='".$giatrisorthientai."&thuonghieu=".$tenth['ThuongHieu']."'>".$tenth['ThuongHieu']."</a></li>
                                            ";
                                        }
                                    }
                        echo "
                                </ul>
                            </li>
                        ";           
                    }else{
                ?>
                    <a href="TimKiem.php?sapxep=ASC" class="submenu-item">Tìm kiếm theo giá tiền <span class="glyphicon glyphicon-chevron-down"></span></a>
                    <ul class="submenu">
                        <li class="submenu-item"><a href="TimKiem.php?dongia=<100000">100.000VND trở xuống</a></li>
                        <li class="submenu-item"><a href="TimKiem.php?dongia=100000-300000">100.000VND-300.000VND</a></li>
                        <li class="submenu-item"><a href="TimKiem.php?dongia=300000-500000">300.000VND-500.000VND</a></li>
                        <li class="submenu-item"><a href="TimKiem.php?dongia=500000-700000">500.000VND-700.000VND</a></li>
                        <li class="submenu-item"><a href="TimKiem.php?dongia=700000-1000000">700.000VND-1.000.000VND</a></li>
                        <li class="submenu-item"><a href="TimKiem.php?dongia=>1000000">1.000.000VND trở lên</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#" class="submenu-item">Tìm kiếm theo thương hiệu <span class="glyphicon glyphicon-chevron-down"></span></a>
                    <ul class="submenu">
                        <?php
                            $sqlthuonghieu="SELECT DISTINCT ThuongHieu from sanpham";
                            $laythuonghieu=$conn->query($sqlthuonghieu);
                            if($laythuonghieu)
                            {
                                while($tenth=$laythuonghieu->fetch_assoc())
                                {
                                    echo"
                                        <li class='submenu-item'><a href='TimKiem.php?thuonghieu=".$tenth['ThuongHieu']."'>".$tenth['ThuongHieu']."</a></li>
                                    ";
                                }
                            }
                        ?>
                    </ul>
                <?php
                    }
                ?>
            </li>
        </ul>
        </div>
        <div id="main-content" class="col-md-12">
        <div id="chiasp" class="row">
        <?php
        $sobanghi1trang=6;
        if(isset($_GET['page']) && is_numeric($_GET['page']))
        {
            $tranghientai=$_GET['page'];
        }else{
            $tranghientai=1;
        }
        $vitribanghibatdau= ($tranghientai-1)*$sobanghi1trang;
        if(isset($_GET['dongia']))
        {
            if($sapxeptheogia!='')
            {
                $gia_tk = $_GET['dongia'];
                if(strpos($gia_tk,'<')!== false)
                {
                    $max=intval(substr($gia_tk,1));
                    $sql="SELECT * FROM sanpham Where DonGia < $max ORDER BY DonGia $sapxeptheogia LIMIT $vitribanghibatdau , $sobanghi1trang  ";
                }elseif(strpos($gia_tk,'>')!== false)
                {
                    $min=intval(substr($gia_tk,1));
                    $sql="SELECT * FROM sanpham Where DonGia > $min ORDER BY DonGia $sapxeptheogia LIMIT $vitribanghibatdau , $sobanghi1trang  ";
                }else{
                    list($min,$max)= explode("-",$gia_tk);
                    $sql="SELECT * FROM sanpham Where DonGia >= $min AND DonGia <= $max ORDER BY DonGia $sapxeptheogia LIMIT $vitribanghibatdau , $sobanghi1trang  ";
                }
            }else{
                $gia_tk = $_GET['dongia'];
                if(strpos($gia_tk,'<')!== false)
                {
                    $max=intval(substr($gia_tk,1));
                    $sql="SELECT * FROM sanpham Where DonGia < $max LIMIT $vitribanghibatdau , $sobanghi1trang ";
                }elseif(strpos($gia_tk,'>')!== false)
                {
                    $min=intval(substr($gia_tk,1));
                    $sql="SELECT * FROM sanpham Where DonGia > $min LIMIT $vitribanghibatdau , $sobanghi1trang ";
                }else{
                    list($min,$max)= explode("-",$gia_tk);
                    $sql="SELECT * FROM sanpham Where DonGia >= $min AND DonGia <= $max LIMIT $vitribanghibatdau , $sobanghi1trang ";
                }
            }
        }elseif (isset($_GET['thuonghieu'])) {
            $thuonghieu = $_GET['thuonghieu'];
            if($sapxeptheogia!='')
            {
                $sql="SELECT * FROM sanpham Where ThuongHieu ='$thuonghieu' order by DonGia $sapxeptheogia  LIMIT $vitribanghibatdau , $sobanghi1trang ";
            }else{
                $sql="SELECT * FROM sanpham Where ThuongHieu ='$thuonghieu' LIMIT $vitribanghibatdau , $sobanghi1trang ";
            }
        }else{
            if($sapxeptheogia!='')
            {
                $sql="SELECT * FROM sanpham Where LOWER(TenSP) LIKE LOWER('%$ndtk%') order by DonGia $sapxeptheogia  LIMIT $vitribanghibatdau , $sobanghi1trang ";
            }else{
                $sql="SELECT * FROM sanpham Where LOWER(TenSP) LIKE LOWER('%$ndtk%') LIMIT $vitribanghibatdau , $sobanghi1trang ";
            }
        }
        
        $result=$conn->query($sql);

        while($row = $result->fetch_assoc())
        {
            echo"
            <div class='col-md-4'>
                    <div class='thumbnail'>
                        <img src='" . $row['HinhAnh'] . "' alt='" . $row['TenSP'] . "'>
                        <div class='caption'>
                            <h4>" . $row['TenSP'] . "</h4>
                            <p>" . number_format($row['DonGia']) . " VNĐ</p>
                            <p>
                                <form method='post'>
                                    <button type='submit' name='mua' class='btn btn-primary'>Mua</button>
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
                    if(isset($_GET['dongia']))
                    {
                        if($sapxeptheogia!='')
                        {
                            $gia_tk = $_GET['dongia'];
                            if(strpos($gia_tk,'<')!== false)
                            {
                                $max=intval(substr($gia_tk,1));
                                $sql="SELECT Count(*) AS soluongsp From sanpham Where DonGia < $max ORDER BY DonGia $sapxeptheogia ";
                            }elseif(strpos($gia_tk,'>')!== false)
                            {
                                $min=intval(substr($gia_tk,1));
                                $sql="SELECT Count(*) AS soluongsp From sanpham Where DonGia > $min ORDER BY DonGia $sapxeptheogia ";
                            }else{
                                list($min,$max)= explode("-",$gia_tk);
                                $sql="SELECT Count(*) AS soluongsp From sanpham Where DonGia >= $min AND DonGia <= $max ORDER BY DonGia $sapxeptheogia ";
                            }
                        }else{
                            $gia_tk = $_GET['dongia'];
                            if(strpos($gia_tk,'<')!== false)
                            {
                                $max=intval(substr($gia_tk,1));
                                $sql="SELECT Count(*) AS soluongsp From sanpham Where DonGia < $max ";
                            }elseif(strpos($gia_tk,'>')!== false)
                            {
                                $min=intval(substr($gia_tk,1));
                                $sql="SELECT Count(*) AS soluongsp From sanpham Where DonGia > $min ";
                            }else{
                                list($min,$max)= explode("-",$gia_tk);
                                $sql="SELECT Count(*) AS soluongsp From sanpham Where DonGia >= $min AND DonGia <= $max ";
                            }
                        }
                    }elseif (isset($_GET['thuonghieu'])) {
                        $thuonghieu = $_GET['thuonghieu'];
                        if($sapxeptheogia!='')
                        {
                            $sql="SELECT Count(*) AS soluongsp From sanpham Where ThuongHieu ='$thuonghieu' order by DonGia $sapxeptheogia";
                        }else{
                            $sql="SELECT Count(*) AS soluongsp From sanpham Where ThuongHieu ='$thuonghieu'";
                        }
                    }else{
                        if($sapxeptheogia!='')
                        {
                            $sql="SELECT Count(*) AS soluongsp From sanpham Where LOWER(TenSP) LIKE LOWER('%$ndtk%') order by DonGia $sapxeptheogia";
                        }else{
                            $sql="SELECT Count(*) AS soluongsp From sanpham Where LOWER(TenSP) LIKE LOWER('%$ndtk%')";
                        }
                    }

                    $kq= $conn->query($sql);
                    $row = $kq->fetch_assoc();
                    $soluongsp= $row['soluongsp'];
                    $sotrang = ceil($soluongsp/$sobanghi1trang);
                    for($i = 1;$i<=$sotrang ; $i++)
                    {
                        if($sapxeptheogia==''&&$thuonghieuhientai==''&&$dongiahientai==''&&$ndtk=='')
                        {
                            echo "<a href='TimKiem.php?page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                        }elseif($ndtk!=''){
                            echo "<a href='TimKiem.php?ndtk=".$ndtk."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                        }else{
                            $urlsapxepmoi='';
                            $urldongiamoi='';
                            $urlthuonghieumoi='';
                            if($sapxeptheogia!='')
                            {
                                $urlsapxepmoi='sapxep='.$sapxeptheogia;
                                if($thuonghieuhientai!='')
                                {
                                    $urlthuonghieumoi='&thuonghieu='.$thuonghieuhientai;
                                }
                                if($dongiahientai!='')
                                {
                                    $urldongiamoi='&dongia='.$dongiahientai;
                                }
                                //echo "<a href='".$urlsapxepmoi.$urldongiamoi.$urlthuonghieumoi."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                            }else{
                                if($dongiahientai!='')
                                {
                                    $urldongiamoi='dongia='.$dongiahientai;
                                    if($thuonghieuhientai!='')
                                    {
                                        $urlthuonghieumoi='&thuonghieu='.$thuonghieuhientai;
                                    }
                                    // echo "<a href='".$urlsapxepmoi.$urldongiamoi.$urlthuonghieumoi."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                                }else{
                                    $urlthuonghieumoi='thuonghieu='.$thuonghieuhientai;
                                }
                            } 
                            echo "<a href='TimKiem.php?".$urlsapxepmoi.$urldongiamoi.$urlthuonghieumoi."&page=" . $i . "' class='btn btn-default'>" . $i . "</a>";
                        }
                        
                    }
                ?>
                <a href=""></a>
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