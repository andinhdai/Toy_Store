-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 10:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_do_choi`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `ID_cmt` int(10) NOT NULL,
  `MaCmtSP` varchar(11) NOT NULL,
  `UserID` int(8) NOT NULL,
  `NoiDung` varchar(150) NOT NULL,
  `NgayCmt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitietloai`
--

CREATE TABLE `chitietloai` (
  `MaLoai` int(3) NOT NULL,
  `ChiTietLoai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chitietloai`
--

INSERT INTO `chitietloai` (`MaLoai`, `ChiTietLoai`) VALUES
(1, 'Khác'),
(1, 'LEGO'),
(2, 'Đồ chơi bác sĩ'),
(2, 'Đồ chơi cứu hỏa'),
(2, 'Đồ chơi nhà bếp , siêu thị'),
(2, 'Khác'),
(3, 'Bột nặn'),
(3, 'Bút màu và bảng vẽ'),
(3, 'Cát động lực'),
(3, 'Khác'),
(3, 'STEAM'),
(4, 'Khác'),
(4, 'Siêu anh hùng'),
(4, 'Siêu Robot'),
(4, 'Siêu thú'),
(5, 'Khác'),
(5, 'Thú bông'),
(5, 'Thú bông có tương tác');

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `Id_Gio` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `Id_HoaDon` int(11) NOT NULL,
  `SoLuongMua` int(11) NOT NULL,
  `DonGia` int(10) NOT NULL,
  `UserID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `Id_HoaDon` int(8) NOT NULL,
  `TenNguoiNhan` varchar(50) NOT NULL,
  `SdtNhan` varchar(15) NOT NULL,
  `DiaChiNhan` varchar(300) NOT NULL,
  `GhiChu` varchar(150) NOT NULL,
  `TongTien` int(10) NOT NULL,
  `NgayLap` date NOT NULL,
  `PhuongThucTT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(8) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Sdt` varchar(15) NOT NULL,
  `DiaChi` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `HoTen`, `Email`, `Sdt`, `DiaChi`) VALUES
(1, 'Đỗ Minh Hiếu', 'dominhhieu@gmail.com', '0357435636', 'Phù Đổng'),
(2, 'An Đình Đại', 'andinhdai@gmail.com', '0357435637', 'Bắc Ninh');

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoai` int(3) NOT NULL,
  `TenLoai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`MaLoai`, `TenLoai`) VALUES
(1, 'Đồ chơi lắp ghép'),
(2, 'Đồ chơi mô phỏng'),
(3, 'Đồ chơi sáng tạo'),
(4, 'Đồ chơi theo phim'),
(5, 'Gấu bông');

-- --------------------------------------------------------

--
-- Table structure for table `phanhoi`
--

CREATE TABLE `phanhoi` (
  `Id_PhanHoi` int(11) NOT NULL,
  `UserID` int(8) NOT NULL,
  `NoiDung` varchar(300) NOT NULL,
  `NgayGui` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(8) NOT NULL,
  `TenSP` varchar(150) NOT NULL,
  `DonGia` int(10) NOT NULL,
  `HinhAnh` varchar(150) NOT NULL,
  `MaLoai` int(3) NOT NULL,
  `MoTa` varchar(500) NOT NULL,
  `SoLuong` int(5) NOT NULL,
  `DaBan` int(8) NOT NULL,
  `ThuongHieu` varchar(50) NOT NULL,
  `MaCmtSP` varchar(11) NOT NULL,
  `ChiTietLoai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `DonGia`, `HinhAnh`, `MaLoai`, `MoTa`, `SoLuong`, `DaBan`, `ThuongHieu`, `MaCmtSP`, `ChiTietLoai`) VALUES
('SP01', 'Câu chuyện phiêu lưu của Ariel, Belle, Cinderella và Tiana', 468000, './anh/DHM_SP01.jpg', 1, 'Đồ Chơi LEGO Câu Chuyện Phiêu Lưu Của Ariel, Belle, Cinderella Và Tiana 43193', 5, 0, 'LEGO DISNEY PRINCESS', 'Cmt_SP01', 'LEGO'),
('SP02', 'Siêu Xe Mclaren Elva', 489000, './anh/DHM_SP02.jpg', 1, 'LEGO Speed Champions 76902 Siêu Xe Mclaren Elva (263 chi tiết)\r\n\"Bộ xây dựng LEGO Speed Champions 76902 Siêu Xe Mclaren Elva (263 chi tiết) này mang đến cho trẻ em và những người đam mê ô tô cơ hội thu thập, chế tạo và khám phá một trong những chiếc xe đua tốc độ độc nhất trên thế giới. Tuyệt đẹp từ mọi góc độ, bản sao chi tiết này mang lại trải nghiệm xây dựng hấp dẫn, thật hoàn hảo để hiển thị và tuyệt vời cho hành động đua siêu khí động học! Chiếc xe đồ chơi sưu tập này đi kèm với một khung g', 5, 0, 'LEGO SPEED CHAMPIONS', 'Cmt_SP02', 'LEGO'),
('SP03', 'Lâu Đài Taj Mahal', 2799000, './anh/DHM_SP03.jpg', 1, 'LEGO Architecture 21056 Lâu Đài Taj Mahal (2022 chi tiết)\r\nCho dù bạn đã đủ may mắn để tự mình đến thăm Taj Mahal và muốn có một món quà lưu niệm đặc biệt về trải nghiệm, hoặc bạn đang ước mơ được đến thăm nơi này một ngày nào đó hay chỉ là niềm yêu thích những tòa nhà trang nhã, bộ sưu tập LEGO Architecture 21056 Lâu Đài Taj Mahal (2022 chi tiết) này là lựa chọn lý tưởng dành cho bạn. Chi tiết tuyệt vời Thử thách xây dựng đầy cảm hứng này mang đến cho bạn những phút giây thư giãn, bạn sẽ được t', 100, 0, 'LEGOARCHITECTURE', 'Cmt_SP03', 'LEGO'),
('SP04', 'Xe Thang Chữa Cháy', 419000, './anh/DHM_SP04.jpg', 1, 'LEGO CITY 60280 Xe Thang Chữa Cháy ( 88 Chi tiết)\r\nMón quà tuyệt với dành cho những đứa trẻ yêu thích đồ chơi hành động, bộ đồ chơi LEGO CITY 60280 Xe Thang Chữa Cháy (88 Chi tiết) này có động cơ chữa cháy mang tính biểu tượng với thang chữa cháy có thể rửa được, cùng với vòi nước và ngọn lửa LEGO có thể xếp chồng lên nhau để có những ngọn lửa lớn hơn!', 100, 0, 'LEGO CITY', 'Cmt_SP04', 'LEGO'),
('SP05', 'Bộ đồ chơi lắp ráp đường ray và xe chạy pin - set cứu hỏa', 509000, './anh/DHM_SP05.jpg', 1, 'Đồ Chơi VECTO Bộ Đồ Chơi Lắp Ráp Đường Ray Và Xe Chạy Pin - Set Cứu Hỏa VT55710A\r\nBộ đồ chơi lắp ráp đường ray và xe chạy pin - set cứu hỏa Vecto là Playset & phụ kiện kết hợp hoàn hảo giữa các mảnh ghép đường ray cùng 8 xe cứu hỏa độc đáo. Trong đó, có 2 xe được trang bị motor có thể chạy trên đường ray sau khi lắp pin.', 100, 0, 'VECTO', 'Cmt_SP05', 'Khác'),
('SP06', 'Bộ đồ chơi lắp ráp Vecto DIY-Xe đào, xe lu, nón và phụ kiện', 449000, './anh/DHM_SP06.jpg', 1, 'Bộ sản phẩm bao gồm: 1 xe lu, 1 xe đào, 1 phụ kiện và 1 nón. Xe hoàn toàn có thể tháo tất cả các bộ phận ra bằng tua vít đi kèm. Giúp bé phát triển tư duy phân tích, vận động tinh ngay từ nhỏ, tạo tiền đề cho việc phát triển tư duy sau này.\r\nVECTO - THẾ GIỚI ĐỒ CHƠI BÉ TRAI CỰC ĐỈNH', 100, 0, 'VECTO', 'Cmt_SP06', 'Khác'),
('SP07', 'Bộ đồ chơi lắp ráp Vecto DIY 3 trong 1 - Xe cứu hỏa', 399000, './anh/DHM_SP07.jpg', 1, 'Đồ Chơi VECTO Bộ Đồ Chơi Lắp Ráp Vecto Diy 3 Trong 1 - Xe Cứu Hỏa VT1072\r\nBộ đồ chơi lắp ráp xe giúp bé phát triển kỹ năng vận động tinh thông qua các thao tác vặn, mở ốc khi chơi. Ngoài ra, bé còn rèn luyện được tư duy logic, kỹ năng khéo léo khi mày mò lắp ráp hơn 25 mảnh ghép thành 1 chiếc xe hoàn chỉnh. Bộ sản phẩm bao gồm cả vít vặn rất vừa tay cho bé ở độ tuổi preschool, nhựa chơi được trong nhà và ngoài trời.\r\nVới nhiều chủ đề và chức năng khác nhau, hãy sưu tập đủ bộ để có thể giáo dục b', 100, 0, 'VECTO', 'Cmt_SP07', 'Khác'),
('SP08', 'Bộ đồ chơi lắp ráp đường ray và xe chạy pin - set xe đua', 384000, './anh/DHM_SP08.jpg', 1, 'Bộ đồ chơi lắp ráp đường ray chủ đề xe đua là sự kết hợp độc đáo giữa hệ thống đường ray và bộ sưu tập xe đua siêu Hot. Trong đó có 1 xe được trang bị Motor có thể chạy sau khi lắp pin.\r\nBộ sưu tập xe đua có vẻ ngoài được thiết kế các đường nét cực kỳ mạnh mẽ. Bằng sự phối hợp màu sắc hài hòa tạo nên một vẻ ngoài cực kỳ thu hút.\r\nNgoài hệ thống đường ray lắp ráp, bộ đồ chơi còn có các chi tiết nhỏ môi trường xung quanh giúp bé trang trí khu vực vui chơi của mình.', 100, 0, 'VECTO', 'Cmt_SP08', 'Khác'),
('SP09', 'Chiến binh thú ZW43 PHANTOTH', 545000, './anh/DHM_SP09.jpg', 1, 'Đồ Chơi Bottleman Robot Nắp Chai Wonder Grape Kỳ Lân 175148\r\nChiến binh thú ZW43 PHANTOTH 122937 là sản phẩm của nhãn hàng Zoids thuộc thương hiệu Takaratomy nổi tiếng tại Nhật Bản. Đồ chơi mô hình này lấy cảm hứng từ bộ phim hoạt hình Zoids - Thú Vương Đại Chiến.', 100, 0, 'ZOIDS 2', 'Cmt_SP09', 'Khác'),
('SP10', 'Combo mô hình 2023 NEW BOY CHARACTER ACTION FIGURE VOL.2 BANDAI CANDY CB-A2709559-4778', 459000, './anh/DHM_SP10.jpg', 1, 'Đồ Chơi Combo Mô Hình 2023 New Boy Character Action Figure Vol.2 BANDAI CANDY CB-A2709559-4778 - Giao hàng ngẫu nhiên\r\nMô hình lắp ráp chất lượng cao đến từ Nhật Bản\r\nChi tiết đặc biệt tinh xảo đến từ các nhân vật trong thế giới Gundam Nhật Bản.', 100, 0, 'BANDAI CANDY', 'Cmt_SP10', 'Khác'),
('SP11', 'Bộ nhà bếp sang trọng', 719000, './anh/DHM_SP11.jpg', 2, 'Đồ Chơi ECOIFFIER Bộ Nhà Bếp Sang Trọng 001696\r\nBộ nhà Bếp hiện đại kết hợp với ẩm thực truyền thống 14 phụ kiện (bếp, nồi nướng, soong, chảo và muỗng dĩa) để nấu ăn giúp bé dễ dàng nhập vai và chơ đồ hàng Đồ chơi đạt chuẩn an toàn Châu Âu', 100, 0, 'ECOIFFIER', 'Cmt_SP11', 'Đồ chơi nhà bếp , siêu thị'),
('SP12', 'Nhà hàng thức ăn nhanh', 599000, './anh/DHM_SP12.jpg', 2, 'Đồ Chơi Nhà Hàng Thức Ăn Nhanh ECOIFFIER 001788\r\nNhà hàng thức anh nhanh là nơi cho bé thỏa thích sắm vai quản lỷ nhà hàng với 23 phụ kiện. Có đầy đủ các món ăn phổ biến: Donut, Hamburger, nước ngọt, cà phê, pizza và trái cây.', 100, 0, 'ECOIFFIER', 'Cmt_SP12', 'Đồ chơi nhà bếp , siêu thị'),
('SP13', 'Máy giặt mini Xanh', 251000, './anh/DHM_SP13.jpg', 2, 'Máy giặt mini nhỏ xinh có đèn, âm thanh và xoay 360 độ như thật, cửa trước đóng mở dễ dàng. Sản phẩm có đi kèm bộ bàn ủi, giỏ và móc treo đồ, giúp bé tập làm quen với công việc vệ sinh quần áo cá nhân, nuôi dưỡng niềm vui được chăm sóc bản thân và gia đình. Combo có 2 màu xanh nhạt và hồng nhạt cho bé lựa chọn', 100, 0, 'SWEET HEART', 'Cmt_SP13', 'Đồ chơi nhà bếp , siêu thị'),
('SP14', 'Trạm Cứu Hỏa Abrick', 599000, './anh/DHM_SP14.jpg', 2, 'Đồ Chơi Trạm Cứu Hỏa Abrick ECOIFFIER 003026\r\nTrạm cứu hỏa Abrick ECOIFFIER 003026 là mô hình đồ chơi mô phỏng trạm cứu hỏa thực tế - một doanh trại hoàn chỉnh với đội ngũ lính cứu hỏa có trình độ cho tất cả các biện pháp can thiệp: trên không, trên đường … giúp dập tắt nhanh chóng vụ hỏa hoạn, đem đến bình yên cho người dân. Thông qua đồ chơi mô phỏng giúp trẻ em học cách hiểu thế giới xung quanh, rèn luyện những kỹ năng cần thiết cho cuộc sống và độc lập hơn mỗi ngày.', 100, 0, 'ECOIFFIER', 'Cmt_SP14', 'Đồ chơi cứu hỏa'),
('SP15', 'Xe cứu hỏa Mercedes Benz và thang xoay, hệ thống bơm nước', 1999000, './anh/DHM_SP15.jpg', 2, 'Đồ Chơi BRUDER Xe Cứu Hỏa Mercedes Benz Và Thang Xoay, Hệ Thống Bơm Nước BRU02673\r\nTiên phong, hiệu quả, đáng tin cậy - đây là cách Mercedes Benz mô tả về chiếc xe cứu hỏa BRU02673 mới. Xe cứu hỏa Mercedes Benz và thang xoay, hệ thống bơm nước BRU02673 là thế hệ mới nhất của BRUDER và tiếp tục là chuyên gia vận tải đa năng và phổ biến. Các phương tiện chữa cháy nhỏ hơn đang được sử dụng ngày càng nhiều cho các đám cháy khó chữa cháy, ví dụ như ở các khu phố cổ chật hẹp.', 100, 0, 'BRUDER', 'Cmt_SP15', 'Đồ chơi cứu hỏa'),
('SP16', 'Vali bác sĩ màu hồng', 265000, './anh/DHM_SP16.jpg', 2, 'Đồ Chơi Vali Bác Sĩ Màu Hồng ECOIFFIER 002875\r\nĐồ chơi vali bác sĩ màu hồng ECOIFFIER 002875 mô phỏng dụng cụ y tế, bé cùng bạn bè sẽ đóng vai y tá hoặc bác sĩ. Thông qua món đồ chơi nhập vai này, bố mẹ có thể giúp con có nhận thức về lĩnh vực y tế, có cái nhìn bao quát về sức khỏe, hơn nữa là không làm con sợ hãi khi đi khám bệnh.', 100, 0, 'ECOIFFIER', 'Cmt_SP16', 'Đồ chơi bác sĩ'),
('SP17', 'Bộ đồ ăn cho bé', 265000, './anh/DHM_SP17.jpg', 2, 'Đồ Chơi Dụng Cụ Nhà Bếp- Bộ Đồ Ăn Cho Bé ECOIFFIER 002877\r\nĐồ chơi đồ dùng nhà bếp Ecoiffier - Bộ đồ ăn cho bé ECOIFFIER 002877 là một bộ sản phẩm không thể thiếu đối với các bé có đam mê về lĩnh vực nấu ăn. Với bộ dụng cụ phong phú đa dạng các bé có thể thỏa sức sáng tạo hóa thân thành một đầu bếp thực thụ, chế biến ra những món ăn, thức uống ngon miệng dành tặng cho bản thân, bạn bè và gia đình.', 100, 0, 'ECOIFFIER', 'Cmt_SP17', 'Khác'),
('SP18', 'Đồ chơi bé làm bác sĩ', 879000, './anh/DHM_SP18.jpg', 2, 'Đồ Chơi B.BRAND Bé Làm Bác Sĩ BX1230Z\r\nĐồ chơi B.BRAND bé làm bác sĩ BX1230Z là đồ chơi hàng đầu tại Canada, sử dụng công nghệ tiên tiến giúp bé có thể vừa vui chơi vừa làm quen với các hoạt động gần gũi với thế giới quan. Các sản phẩm đồ chơi B.Brand đều có một giá trị nhất định về giáo dục, phát triển kỹ năng vận động, tư duy logic, sự sáng tạo qua các dòng sản phẩm đồ chơi của hãng.', 100, 0, 'B.BRAND', 'Cmt_SP18', 'Đồ chơi bác sĩ'),
('SP19', 'ATM mini hồng xinh xắn', 629000, './anh/DHM_SP19.jpg', 2, 'Đồ Chơi SWEET HEART Máy ATM Mini Hồng Xinh Xắn WS5376\r\nMáy ATM mini với chức năng như 1 chiếc máy ATM ngoài đời thật. Có mã khóa bảo mật để bảo vệ tiền tiết kiệm của bé.', 100, 0, 'SWEET HEART', 'Cmt_SP19', 'Khác'),
('SP20', 'Cửa hàng bánh ngọt', 769000, './anh/DHM_SP20.jpg', 1, 'Đồ Chơi LIL WOODZEEZ Cửa Hàng Bánh Ngọt WZ6619Z\r\nThưởng thức một số món ngon với Cửa hàng bánh ngọt của Li’l Woodzeez!', 100, 0, 'LIL WOODZEEZ', 'Cmt_SP20', 'Khác'),
('SP21', 'Tiệm kem ngọt ngào', 454000, './anh/DHM_SP21.jpg', 2, 'Đồ Chơi LIL WOODZEEZ Tiệm Kem Ngọt Ngào WZ6627Z\r\nĐồ chơi mô hình Lil Woodzeez – Tiệm kem ngọt ngào 6162Z mô phỏng một cửa hàng bán kem, với nhiều loại kem cùng các mùi vị khác nhau được trưng bày vô cùng bắt mắt, màu sắc dễ thương. Tiệm kem ngọt ngào luôn sẵn sàng nhận các đơn hàng và phục vụ những món tráng miệng hấp dẫn cho bạn! Đồ chơi mô hình tiệm kem ngọt ngào Lil Woodzeez là một sản phẩm vô cùng thích hợp trong việc giáo dục cho trẻ nhỏ cách nhận dạng những sự vật, hiện tượng có trong cuộc', 100, 0, 'LIL WOODZEEZ', 'Cmt_SP21', 'Đồ chơi nhà bếp , siêu thị'),
('SP22', 'Nhà giữ trẻ vui nhộn', 454000, './anh/DHM_SP22.jpg', 2, 'Đồ Chơi LIL WOODZEEZ Nhà Giữ Trẻ Vui Nhộn WZ6622Z\r\nĐồ chơi mô hình Lil Woodzeez – Nhà giữ trẻ vui nhộn là sản phẩm hoàn hảo trong việc phát huy trí tưởng tượng của các bé. Sở hữu một ngôi nhà xinh xắn cùng với các nội thất nhỏ với hình dáng gần gũi với cuộc sống, đồ chơi mô phỏng cửa hàng này sẽ mang đến cho bé những giây phút vui chơi và học tập thú vị nhất.', 100, 0, 'LIL WOODZEEZ', 'Cmt_SP22', 'Khác'),
('SP23', 'Đồ chơi tự làm Xà Phòng', 139000, './anh/DHM_SP23.jpg', 3, 'Đồ chơi khoa học STEAM hàng đầu nước Mỹ của nhãn hàng DISCOVERY #MINDBLOWN, hợp tác cùng kênh truyền hình nổi tiếng DISCOVERY, đem lại cho bé những trải nghiệm khoa học ứng dụng vừa học, vừa chơi.\r\n- ĐỒ CHƠI TỰ LÀM XÀ PHÒNG với những dụng cụ cần thiết, để tạo ra những viên xà phòng thật thơm, nhiều màu sắc và hình dạng thật xinh xắn. Sản phẩm có thể sử dụng sau khi chế tạo xà phòng hoàn tất.', 100, 0, 'STEAM', 'Cmt_SP23', 'STEAM'),
('SP24', 'Bộ dụng cụ làm đẹp cho thú cưng mini', 99000, './anh/DHM_SP24.jpg', 3, 'Đồ Chơi CRAYOLA Bộ Dụng Cụ Làm Đẹp Cho Thú Cưng Mini 747300\r\nBộ Dụng Cụ Làm Đẹp Cho Thú Cưng Mini - 747300 giúp bé thỏa sức tô vẽ, trang trí cho bạn thú cưng của mình những bộ trang phục xinh xắn, giúp bé phát triển khả năng sáng tạo và sự khéo léo.', 100, 0, 'CRAYOLA', 'Cmt_SP24', 'Khác'),
('SP25', 'Bảng vẽ thông minh Xanh', 299000, './anh/DHM_SP25.jpg', 3, 'Đồ Chơi COOLKIDS Bảng Vẽ Thông Minh Xanh ZJ15/BL\r\nBảng vẽ thông minh tự xóa giúp bé vẽ và ghi lại những hình ảnh, ý tưởng, những điều mới lạ, bổ ích mà bé được học và quan sát hằng ngày một cách dễ dàng và tiện lợi nhất.', 100, 0, 'COOLKIDS', 'Cmt_SP25', 'Bút màu và bảng vẽ'),
('SP26', 'Bảng vẽ chân đứng 2 mặt kèm phụ kiện', 1119000, './anh/DHM_SP26.jpg', 3, 'Bảng Vẽ Chân Đứng 2 Mặt Kèm Phụ Kiện GROWN UP 5091\r\nBảng vẽ chân đứng 2 mặt kèm phụ kiện GROWN UP 5091 là sản phẩm phát triển trí tuệ, giúp bé vừa học, làm quen với chữ số, vừa phát triển năng khiếu hội họa ngay trên chính bảng vẽ này. Bảng vẽ có thể sử dụng cùng lúc 2 mặt: phấn và bút lông. Có khay nhựa chứa đồ tiện dụng, giúp bé bảo quản dụng cụ hay thuận tiện hơn trong việc sử dụng. Có nhiều phụ kiện đi kèm giúp bé thỏa thích sáng tạo. Bố mẹ hãy mua Bảng vẽ chân đứng để làm quà cho trẻ ngay n', 100, 0, 'GROWN UP', 'Cmt_SP26', 'Bút màu và bảng vẽ'),
('SP27', 'Tập tô màu – khám phá vũ trụ cùng mèo con', 39000, './anh/DHM_SP27.jpg', 3, 'Đồ Chơi Tập Tô Màu – Khám Phá Vũ Trụ Cùng Mèo Con CRAYOLA 040679\r\n- Sản phẩm gồm: 20 trang giấy tô màu, sticker chủ đề thám hiểm vũ trụ của bạn mèo nhỏ đáng yêu, 4 bút sáp màu Crayola.\r\n- Cho bé vừa chơi, vừa phát triển khả năng sáng tạo của mình và tìm hiểu thêm về thế giới vụ trụ bao la.', 100, 0, 'CRAYOLA', 'Cmt_SP27', 'Bút màu và bảng vẽ'),
('SP28', 'Hộp bột nặn Playdoh màu xanh dương đậm', 29000, './anh/DHM_SP28.jpg', 3, 'Đồ Chơi PLAYDOH Hộp Bột Nặn Playdoh Màu Xanh Dương Đậm DAM/B5517C/BL\r\nSản phẩm phù hợp cho bé từ 2 tuổi trở lên. Ở độ tuổi này, bé rất thích cầm nắm và vò nắn và giai đoạn này bé học rất nhanh về các giác quan. Chơi bột nặn giúp bé phát triển giác quan thông qua việc học màu sắc, tiếp xúc với chất bột mềm mịn sẽ kích thích bé cầm nắm, vò nắn.Bột nặn màu hồng đậm riêng biệt cho bé có thể chọn theo ý thích để thực hiện tác phẩm sáng tạo của mình.', 100, 0, 'PLAYDOH', 'Cmt_SP28', 'Bột nặn'),
('SP29', 'Que kem 7 màu', 379000, './anh/DHM_SP29.jpg', 3, 'Que kem 7 màu Playdoh đi kèm với 2 cái ốc quế và 2 loại kem cây cho bé tha hồ tưởng tượng, tất cả đều được đựng trong 1 chiếc hộp mô phỏng như tủ đựng kem mini.', 100, 0, 'PLAYDOH', 'Cmt_SP29', 'Khác'),
('SP30', 'Bộ cát, dụng cụ và khay chơi cát', 579000, './anh/DHM_SP30.jpg', 3, 'Bộ cát, dụng cụ và khay chơi cát - 6024397\r\n6024397 - Bộ cát, dụng cụ và khay chơi cát', 100, 0, 'KINETIC SAND', 'Cmt_SP30', 'Cát động lực'),
('SP31', 'Combo 3 bộ khuôn cát', 166000, './anh/DHM_SP31.jpg', 3, 'Kinetic sand là cát động lực được làm từ 100% cát tự nhiên, tuyệt đối an toàn, không bị khô sau thời gian dài sử dụng và dễ dàng vệ sinh, làm sạch sau khi chơi Bé có thể bóp, nặn cát và tạo khuôn thành những hình dạng khác nhau, kết hợp để tạo các lâu đài cát trên biển, các chiếc bánh cookie….', 100, 0, 'KINETIC SAND', 'Cmt_SP31', 'Cát động lực'),
('SP32', 'Mô hình khiên chiến đấu tấn công Iron man dòng Mech Strike', 599000, './anh/DHM_SP32.jpg', 4, 'Các siêu anh hùng Avengers cần những vũ khí mạnh mẽ mới nhất để chống lại những kẻ tấn công từ thiên hà. Khi các mối đe dọa đến với thế giới, trẻ em có thể tưởng tượng chúng sẽ trang bị cho Avengers các vũ khí tương ứng với mỗi \"vị khách không mời\"!', 100, 0, 'AVENGERS', 'Cmt_SP32', 'Siêu anh hùng'),
('SP33', 'Mô hình Captain dòng Mech Strike 6 inch', 357000, './anh/DHM_SP33.jpg', 4, 'Đồ Chơi AVENGERS Mô Hình Captain Dòng Mech Strike 6 Inch F1664\r\nCác siêu anh hùng Avengers cần những vũ khí mạnh mẽ mới nhất để chống lại những kẻ tấn công từ thiên hà.\r\n', 100, 0, 'AVENGERS', 'Cmt_SP33', 'Siêu anh hùng'),
('SP34', 'Mô hình Hulk dòng Mech Strike 6 inch', 357000, './anh/DHM_SP34.jpg', 4, 'Các siêu anh hùng Avengers cần những vũ khí mạnh mẽ mới nhất để chống lại những kẻ tấn công từ thiên hà.\r\nKhi các mối đe dọa đến với thế giới, trẻ em có thể tưởng tượng chúng sẽ trang bị cho Avengers các vũ khí tương ứng với mỗi \"vị khách không mời\"! Liệu những vũ khí Mech Strike nâng cao này có đủ giúp Người Khổng Lồ Xanh Hulk tiết kiệm thời gian chiến đấu không?', 100, 0, 'AVENGERS', 'Cmt_SP34', 'Siêu anh hùng'),
('SP35', 'Siêu anh hùng Captain America tối tân 30cm', 611000, './anh/DHM_SP35.jpg', 4, 'Đồ chơi siêu anh hùng Siêu anh hùng Captain America tối tân 30cm Tính năng : Nhân vật Đội trưởng Steve Rogers với bộ giáp Captain American đặc trưng của anh được thu nhỏ lại sống động như thật - chiều cao 30cm. Bộ phụ kiện vũ khi đi kèm có thể tháo lắp dễ dàng, khiên có thể phóng ra. Đặc tính : Phát triển tư duy ngôn ngữ, tư duy cảm xúc. Chất liệu: Nhựa cao cấp an toàn cho trẻ Kích thước, Kích thước: 6.4 x 22.9 x 30.5 cm AVENGERS Là thương hiệu đồ chơi uy tín và nổi tiếng với các dòng đồ chơi mô', 100, 0, 'AVENGERS', 'Cmt_SP35', 'Siêu anh hùng'),
('SP36', 'Robot Biến hình Cỡ lớn Donnie Xây dựng và thú cưng Donnie', 424000, './anh/DHM_SP36.jpg', 4, 'Đồ Chơi SUPERWINGS Robot Biến Hình Cỡ Lớn Donnie Xây Dựng Kết Hợp Thú Cưng Donn YW750942\r\nSUPER WINGS là bộ phim hoạt hình nổi tiếng, nhận được nhiều sự yêu thích của trẻ em trên toàn thế giới. Robot Biến hình Cỡ lớn Donnie Xây dựng kết hợp thú cưng Donnie mang đến sự khám phá mới cho bé:', 100, 0, 'SUPERWINGS', 'Cmt_SP36', 'Siêu Robot'),
('SP37', 'Siêu Robot Kết hợp siêu xe cứu hộ Donnie xây dựng nâng cấp', 769000, './anh/DHM_SP37.jpg', 4, 'Đồ Chơi SUPERWINGS Siêu Robot Kết Hợp Siêu Xe Cứu Hộ Donnie Xây Dựng Nâng Cấp YW750322\r\nSản phẩm Siêu Robot Kết hợp siêu xe cứu hộ Donnie xây dựng nâng cấp là sản phẩm thuộc thương hiệu SUPERWINGS, một sản phẩm đến từ Series phim hoạt hình nổi tiếng được yêu thích trên toàn thế giới - SUPERWINGS ĐỘI BAY SIÊU ĐẲNG. Các sản phẩm nhập vai cho bộ phim hoạt hình được các bé đặc biệt yêu thích và sưu tập với niềm đam mê và sự hứng thú.', 100, 0, 'SUPERWINGS', 'Cmt_SP37', 'Siêu Robot'),
('SP38', 'Trứng biến hình Robot Leo mạnh mẽ', 199000, './anh/DHM_SP38.jpg', 4, 'Đồ Chơi SUPERWINGS  Trứng Biến Hình Robot Leo Mạnh Mẽ YW750567\r\nSản phẩm Trứng biến hình Robot Leo mạnh mẽ là sản phẩm thuộc thương hiệu SUPERWINGS, một sản phẩm đến từ Series phim hoạt hình nổi tiếng được yêu thích trên toàn thế giới - SUPERWINGS ĐỘI BAY SIÊU ĐẲNG. Các sản phẩm nhập vai cho bộ phim hoạt hình được các bé đặc biệt yêu thích và sưu tập với niềm đam mê và sự hứng thú.', 100, 0, 'SUPERWINGS', 'Cmt_SP38', 'Khác'),
('SP39', 'Mô hình Mixmaster dòng Studio Voyager', 1659000, './anh/DHM_SP39.jpg', 4, 'Đồ Chơi Mô Hình Mixmaster Dòng Studio Voyager TRANSFORMERS E7215/E0702\r\nMô hình Mixmaster dòng Studio Voyager TRANSFORMERS E7215/E0702 là đồ chơi được lấy cảm hứng từ những cảnh phim mang tính biểu tượng, phản ánh vũ trụ điện ảnh Transformers. Các chi tiết được thiết kế tỉ mỉ, chăm chút đầy sống động. Đặc biệt mô hình có thể chuyển đổi qua lại giữa rô bốt cực ngầu và xe trộn xi măng chỉ trong vài bước đơn giản. Mua ngay mô hình độc đáo này làm quà dành tặng con yêu của bạn ngay hôm nay!', 100, 0, 'TRANSFORMERS', 'Cmt_SP39', 'Khác'),
('SP40', 'Xe cứu hộ cơ bản Paw Patrol - Marshall', 359000, './anh/DHM_SP40.jpg', 4, 'Đồ Chơi PAW PATROL Xe Cứu Hộ Cơ Bản - Marshall 6061798', 100, 0, 'PAW PATROL', 'Cmt_SP40', 'Siêu thú'),
('SP41', 'Đồ chơi xe cảnh sát mini Paw Patrol The Movie - Chase', 223000, './anh/DHM_SP41.jpg', 4, 'Đồ Chơi PAW PATROL Đồ Chơi Xe Cảnh Sát Mini The Movie - Chase 6060771\r\nThương hiệu Canada. Được mô phỏng theo bộ phim hoạt hình nổi tiếng Đội Chó Cứu Hộ Paw Patrol. Từ màn ảnh nhỏ bước ra công chiếu thể giới với tên gọi Paw Patrol The Movie.', 100, 0, 'PAW PATROL', 'Cmt_SP41', 'Khác'),
('SP42', 'Xe cứu hộ Paw Patrol The Movie - Skye', 384000, './anh/DHM_SP42.jpg', 4, 'Đồ Chơi PAW PATROL Xe Cứu Hộ The Movie - Skye 6060436', 100, 0, 'PAW PATROL', 'Cmt_SP42', 'Siêu thú'),
('SP43', 'Mèo con - Baby Persian IWAYA 3303-2VN-JS', 299000, './anh/DHM_SP43.jpg', 5, 'Đồ Chơi Thú Bông Tương Tác Mèo Con - Baby Persian IWAYA 3303-2VN-JS\r\nIWAYA là thương hiệu đồ chơi thú cưng có hơn 100 năm danh tiếng tại xứ hoa anh đào Nhật Bản. IWAYA luôn hướng đến việc mang lại những bé thú cưng đồ chơi đáng yêu nhất cho trẻ em trên toàn cầu. Với chất lượng Nhật Bản, IWAYA là lựa chọn an toàn tuyệt vời để làm quà cho bé.', 100, 0, 'IWAYA', 'Cmt_SP43', 'Thú bông có tương tác'),
('SP44', 'Chim Cánh Cụt Con IWAYA 3243-1VN-JS', 399000, './anh/DHM_SP44.jpg', 5, 'Đồ Chơi Thú Bông Tương Tác Chim Cánh Cụt Con IWAYA 3243-1VN-JS\r\nIWAYA là thương hiệu đồ chơi thú cưng có hơn 100 năm danh tiếng tại xứ hoa anh đào Nhật Bản. IWAYA luôn hướng đến việc mang lại những bé thú cưng đồ chơi đáng yêu nhất cho trẻ em trên toàn cầu. Với chất lượng Nhật Bản, IWAYA là lựa chọn an toàn tuyệt vời để làm quà cho bé.', 100, 0, 'IWAYA', 'Cmt_SP44', 'Thú bông có tương tác'),
('SP45', 'Thỏ Con R/C - Iris IWAYA 3158-1VN-JS', 399000, './anh/DHM_SP45.jpg', 5, 'Đồ Chơi Thú Bông Tương Tác IWAYA 3158-1VN-JS Thỏ Con R/C - Iris\r\nIWAYA là thương hiệu đồ chơi thú cưng có hơn 100 năm danh tiếng tại xứ hoa anh đào Nhật Bản. IWAYA luôn hướng đến việc mang lại những bé thú cưng đồ chơi đáng yêu nhất cho trẻ em trên toàn cầu. Với chất lượng Nhật Bản, IWAYA là lựa chọn an toàn tuyệt vời để làm quà cho bé.\r\n', 100, 0, 'IWAYA', 'Cmt_SP45', 'Thú bông có tương tác'),
('SP46', 'Thú nhồi bông - Vịt vàng 40cm SWEET HEART PLUSH AH23008/40', 319000, './anh/DHM_SP46.jpg', 5, 'Đồ Chơi Thú Nhồi Bông - Vịt Vàng 40 cm SWEET HEART PLUSH AH23008/40\r\nĐồ chơi thú nhồi bông SWEET HEART – với nhiều hình dạng và kích thước khác nhau cho bé thoải mái lựa chọn. Ngoài ra, với chất lông mềm mịn, tạo cảm giác dễ chịu và an toàn cho bé khi ôm ấp.\r\nHình dạng vô cùng đa dạng, như hình thú vật, các sinh vật huyền thoại, nhân vật hoạt hình, v.v.. Bé có thể dùng chúng để chơi cùng, để trưng bày, để sưu tập hoặc để làm quà tặng.\r\n', 100, 0, 'SWEET HEART PLUSH', 'Cmt_SP46', 'Thú bông'),
('SP47', 'Thú nhồi bông - Heo nơ hồng 30cm SWEET HEART PLUSH AH23003/30', 299000, './anh/DHM_SP47.jpg', 1, 'Đồ Chơi Thú Nhồi Bông - Heo Nơ Hồng 30 cm SWEET HEART PLUSH AH23003/30\r\nĐồ chơi thú nhồi bông SWEET HEART – với nhiều hình dạng và kích thước khác nhau cho bé thoải mái lựa chọn. Ngoài ra, với chất lông mềm mịn, tạo cảm giác dễ chịu và an toàn cho bé khi ôm ấp.\r\nHình dạng vô cùng đa dạng, như hình thú vật, các sinh vật huyền thoại, nhân vật hoạt hình, v.v.. Bé có thể dùng chúng để chơi cùng, để trưng bày, để sưu tập hoặc để làm quà tặng.', 100, 0, 'SWEET HEART PLUSH', 'Cmt_SP47', 'Khác'),
('SP48', 'Thú nhồi bông - Thỏ ăn cà rốt 52cm SWEET HEART PLUSH AH21010/52', 319000, './anh/DHM_SP48.jpg', 5, 'Đồ Chơi Thú Nhồi Bông - Thỏ Ăn Cà Rốt 52 cm SWEET HEART PLUSH AH21010/52\r\nĐồ chơi thú nhồi bông SWEET HEART – với nhiều hình dạng và kích thước khác nhau cho bé thoải mái lựa chọn. Ngoài ra, với chất lông mềm mịn, tạo cảm giác dễ chịu và an toàn cho bé khi ôm ấp.\r\nHình dạng vô cùng đa dạng, như hình thú vật, các sinh vật huyền thoại, nhân vật hoạt hình, v.v.. Bé có thể dùng chúng để chơi cùng, để trưng bày, để sưu tập hoặc để làm quà tặng.', 100, 0, 'SWEET HEART PLUSH', 'Cmt_SP48', 'Thú bông'),
('SP49', 'Thú nhồi bông - Gấu nâu 24cm SWEET HEART PLUSH AH22034/24', 169000, './anh/DHM_SP49.jpg', 5, 'Đồ Chơi Thú Nhồi Bông - Gấu Nâu 24 cm SWEET HEART PLUSH AH22034/24\r\nĐồ chơi thú nhồi bông SWEET HEART – với nhiều hình dạng và kích thước khác nhau cho bé thoải mái lựa chọn. Ngoài ra, với chất lông mềm mịn, tạo cảm giác dễ chịu và an toàn cho bé khi ôm ấp.\r\nHình dạng vô cùng đa dạng, như hình thú vật, các sinh vật huyền thoại, nhân vật hoạt hình, v.v.. Bé có thể dùng chúng để chơi cùng, để trưng bày, để sưu tập hoặc để làm quà tặng.\r\n', 100, 0, 'SWEET HEART PLUSH', 'Cmt_SP49', 'Khác'),
('SP50', 'Thú nhồi bông - Vịt đội nón ếch 30cm SWEET HEART PLUSH AH23040/30', 229000, './anh/DHM_SP50.jpg', 5, 'Đồ Chơi Thú Nhồi Bông - Vịt Đội Nón Ếch 30 cm SWEET HEART PLUSH AH23040/30\r\nĐồ chơi thú nhồi bông SWEET HEART – với nhiều hình dạng và kích thước khác nhau cho bé thoải mái lựa chọn. Ngoài ra, với chất lông mềm mịn, tạo cảm giác dễ chịu và an toàn cho bé khi ôm ấp.\r\nHình dạng vô cùng đa dạng, như hình thú vật, các sinh vật huyền thoại, nhân vật hoạt hình, v.v.. Bé có thể dùng chúng để chơi cùng, để trưng bày, để sưu tập hoặc để làm quà tặng.\r\n\r\n', 100, 0, 'SWEET HEART PLUSH', 'Cmt_SP50', 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `UserID` int(8) NOT NULL,
  `User` varchar(50) NOT NULL,
  `Pass` varchar(18) NOT NULL,
  `MaKH` int(8) NOT NULL,
  `Quyen` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`UserID`, `User`, `Pass`, `MaKH`, `Quyen`) VALUES
(1, 'dominhhieu', 'admin123', 1, 2),
(2, 'andinhdai', 'admin123', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`ID_cmt`),
  ADD KEY `Fk_uidCmt` (`UserID`),
  ADD KEY `FK_MaCmt` (`MaCmtSP`);

--
-- Indexes for table `chitietloai`
--
ALTER TABLE `chitietloai`
  ADD PRIMARY KEY (`MaLoai`,`ChiTietLoai`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`Id_Gio`),
  ADD KEY `FK_uidMua` (`UserID`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`Id_HoaDon`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoai`),
  ADD UNIQUE KEY `TenLoai` (`TenLoai`);

--
-- Indexes for table `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`Id_PhanHoi`),
  ADD KEY `Fk_uid` (`UserID`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD UNIQUE KEY `MaCmtSP` (`MaCmtSP`),
  ADD KEY `FK_loaisp` (`MaLoai`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `User` (`User`),
  ADD KEY `FK_MaKH` (`MaKH`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `ID_cmt` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `Id_Gio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `Id_HoaDon` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoai` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `Id_PhanHoi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `UserID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `FK_MaCmt` FOREIGN KEY (`MaCmtSP`) REFERENCES `sanpham` (`MaSP`),
  ADD CONSTRAINT `Fk_uidCmt` FOREIGN KEY (`UserID`) REFERENCES `taikhoan` (`UserID`);

--
-- Constraints for table `chitietloai`
--
ALTER TABLE `chitietloai`
  ADD CONSTRAINT `chitietloai_ibfk_1` FOREIGN KEY (`MaLoai`) REFERENCES `loaisp` (`MaLoai`);

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `FK_uidMua` FOREIGN KEY (`UserID`) REFERENCES `taikhoan` (`UserID`);

--
-- Constraints for table `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD CONSTRAINT `Fk_uid` FOREIGN KEY (`UserID`) REFERENCES `taikhoan` (`UserID`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_loaisp` FOREIGN KEY (`MaLoai`) REFERENCES `loaisp` (`MaLoai`);

--
-- Constraints for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `FK_MaKH` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
