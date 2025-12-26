-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2025 at 12:26 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quan_ly_thu_vien`
--

-- --------------------------------------------------------

--
-- Table structure for table `mua_sach`
--

CREATE TABLE `mua_sach` (
  `id_mua` int NOT NULL,
  `id_sach` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `ngay_mua` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mua_sach`
--

INSERT INTO `mua_sach` (`id_mua`, `id_sach`, `id_user`, `ngay_mua`) VALUES
(1, 9, 1, '2025-12-25'),
(2, 10, 1, '2025-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `id_user` int NOT NULL,
  `ten_dang_nhap` varchar(50) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `nam_sinh` int DEFAULT NULL,
  `sdt` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `quoc_gia_id` int DEFAULT NULL,
  `vai_tro_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id_user`, `ten_dang_nhap`, `mat_khau`, `ten`, `nam_sinh`, `sdt`, `email`, `quoc_gia_id`, `vai_tro_id`) VALUES
(1, 'admin', '123456', 'Nguyễn Văn Admin', 1990, '0901234567', 'admin@library.vn', 1, 1),
(2, 'manager1', '123456', 'Trần Thị Quản Lý', 1985, '0902345678', 'manager@library.vn', 1, 2),
(3, 'staff1', '123456', 'Lê Văn Nhân Viên', 1995, '0903456789', 'staff1@library.vn', 1, 3),
(4, 'vip1', '123456', 'Phạm Thị VIP', 1992, '0904567890', 'vip1@gmail.com', 1, 4),
(5, 'user1', '123456', 'Hoàng Văn A', 1998, '0905678901', 'user1@gmail.com', 1, 5),
(6, 'user2', '123456', 'Đỗ Thị B', 2000, '0906789012', 'user2@gmail.com', 1, 5),
(7, 'user3', '123456', 'Vũ Văn C', 1997, '0907890123', 'user3@gmail.com', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `quoc_gia`
--

CREATE TABLE `quoc_gia` (
  `id` int NOT NULL,
  `ten_quoc_gia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quoc_gia`
--

INSERT INTO `quoc_gia` (`id`, `ten_quoc_gia`) VALUES
(1, 'Việt Nam'),
(2, 'Mỹ'),
(3, 'Anh'),
(4, 'Nhật Bản'),
(5, 'Hàn Quốc'),
(6, 'Trung Quốc'),
(7, 'Pháp'),
(8, 'Đức'),
(9, 'Nga'),
(10, 'Ấn Độ');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `id_sach` int NOT NULL,
  `ten_sach` varchar(255) NOT NULL,
  `so_luong` int DEFAULT '0',
  `the_loai` varchar(100) DEFAULT NULL,
  `gia_thue` decimal(10,2) DEFAULT NULL,
  `gia_ban` decimal(10,2) DEFAULT NULL,
  `nam_xuat_ban` int DEFAULT NULL,
  `mo_ta` text,
  `anh_bia` varchar(255) DEFAULT NULL,
  `quoc_gia_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`id_sach`, `ten_sach`, `so_luong`, `the_loai`, `gia_thue`, `gia_ban`, `nam_xuat_ban`, `mo_ta`, `anh_bia`, `quoc_gia_id`) VALUES
(1, 'Mắt biếc', 15, 'Tiểu thuyết', 15000.00, 89000.00, 2020, 'Truyện tình cảm động của Nguyễn Nhật Ánh', 'uploads/anh10.jpg', 1),
(2, 'Tôi thấy hoa vàng trên cỏ xanh', 20, 'Tiểu thuyết', 18000.00, 95000.00, 2019, 'Câu chuyện tuổi thơ miền quê', 'uploads/anh9.jpg', 1),
(3, 'Dế Mèn phiêu lưu ký', 25, 'Thiếu nhi', 10000.00, 68000.00, 2021, 'Tác phẩm văn học thiếu nhi kinh điển', 'uploads/anh8.jpg', 1),
(4, 'Đắc nhân tâm', 30, 'Kỹ năng sống', 20000.00, 89000.00, 2022, 'Nghệ thuật thu phục lòng người', 'uploads/anh7.jpg', 2),
(5, 'Nhà giả kim', 17, 'Tiểu thuyết', 15000.00, 79000.00, 2020, 'Hành trình tìm kiếm giấc mơ', 'uploads/anh6.jpg', 7),
(6, 'Harry Potter và Hòn đá phù thủy', 12, 'Phiêu lưu', 25000.00, 149000.00, 2019, 'Phần 1 của series Harry Potter', 'uploads/anh5.jpg', 3),
(7, '1Q84', 9, 'Tiểu thuyết', 30000.00, 279000.00, 2021, 'Tiểu thuyết siêu thực Nhật Bản', 'uploads/anh4.jpg', 4),
(8, 'Trăm năm cô đơn', 8, 'Tiểu thuyết', 25000.00, 159000.00, 2020, 'Hiện thực huyền ảo độc đáo', 'uploads/anh3.jpg', 7),
(9, 'Ông già và biển cả', 18, 'Tiểu thuyết', 12000.00, 59000.00, 2021, 'Câu chuyện về sự kiên trì', 'uploads/anh2.jpg', 2),
(10, 'Tội ác và hình phạt', 14, 'Tâm lý', 28000.00, 189000.00, 2019, 'Tác phẩm tâm lý tội phạm nổi tiếng', 'uploads/anh1.jpg', 9),
(11, 'Harry Potter và chiếc cốc lửa', 12, 'Tiểu thuyết', 29000.00, 239000.00, 2000, '123', 'uploads/anh11.jpg', 3),
(12, 'Doraemon vol 21', 22, 'Truyện tranh', 19000.00, 79000.00, 2002, '1', 'uploads/anh12.jpg', 4),
(13, 'Doraemon vol 10', 11, 'Truyện tranh', 19000.00, 79000.00, 2000, '1', 'uploads/anh13.jpg', 4),
(14, 'Giáo trình lịch sử Đảng', 8, 'Sách giáo khoa', 19000.00, 89000.00, 2021, '1', 'uploads/anh14.jpg', 1),
(15, 'Tư tưởng Hồ Chí Minh', 34, 'Sách giáo khoa', 25000.00, 49000.00, 2021, '1', 'uploads/anh15.jpg', 1),
(16, 'Số đỏ', 10, 'Tiểu thuyết', 15000.00, 85000.00, 2018, 'Tác phẩm nổi tiếng của Vũ Trọng Phụng', 'uploads/anh16.jpg', 1),
(17, 'Chí Phèo', 12, 'Tiểu thuyết', 12000.00, 75000.00, 2019, 'Truyện ngắn kinh điển của Nam Cao', 'uploads/anh17.jpg', 1),
(18, 'Lão Hạc', 15, 'Tiểu thuyết', 10000.00, 70000.00, 2020, 'Câu chuyện cảm động về số phận người nông dân', 'uploads/anh18.jpg', 1),
(19, 'Nhật ký Đặng Thùy Trâm', 8, 'Tiểu thuyết', 18000.00, 95000.00, 2017, 'Nhật ký chiến tranh xúc động', 'uploads/anh19.jpg', 1),
(20, 'Sherlock Holmes: Chiếc nhẫn máu', 20, 'Trinh thám', 20000.00, 120000.00, 2021, 'Tác phẩm trinh thám nổi tiếng của Conan Doyle', 'uploads/anh20.jpg', 3),
(21, 'Tiếng chim hót trong bụi mận gai', 14, 'Tiểu thuyết', 22000.00, 135000.00, 2019, 'Tiểu thuyết tình cảm nổi tiếng', 'uploads/anh21.jpg', 7),
(22, 'Cuốn theo chiều gió', 18, 'Tiểu thuyết', 25000.00, 150000.00, 2020, 'Tác phẩm kinh điển của Margaret Mitchell', 'uploads/anh22.jpg', 2),
(23, 'Chiến tranh và hòa bình', 10, 'Tiểu thuyết', 30000.00, 180000.00, 2018, 'Tác phẩm đồ sộ của Lev Tolstoy', 'uploads/anh23.jpg', 9),
(24, 'Những người khốn khổ', 16, 'Tiểu thuyết', 28000.00, 160000.00, 2019, 'Tác phẩm nổi tiếng của Victor Hugo', 'uploads/anh24.jpg', 7),
(25, 'Hoàng tử bé', 25, 'Thiếu nhi', 15000.00, 90000.00, 2021, 'Truyện thiếu nhi nổi tiếng của Antoine de Saint-Exupéry', 'uploads/anh25.jpg', 7),
(26, 'Đồi gió hú', 12, 'Tiểu thuyết', 20000.00, 110000.00, 2020, 'Tác phẩm của Emily Brontë', 'uploads/anh26.jpg', 3),
(27, 'Jane Eyre', 14, 'Tiểu thuyết', 22000.00, 125000.00, 2019, 'Tác phẩm của Charlotte Brontë', 'uploads/anh27.jpg', 3),
(28, 'Kiêu hãnh và định kiến', 20, 'Tiểu thuyết', 23000.00, 130000.00, 2018, 'Tác phẩm của Jane Austen', 'uploads/anh28.jpg', 3),
(29, 'Trại súc vật', 15, 'Tiểu thuyết', 18000.00, 95000.00, 2021, 'Tác phẩm châm biếm của George Orwell', 'uploads/anh29.jpg', 3),
(30, '1984', 12, 'Tiểu thuyết', 20000.00, 120000.00, 2019, 'Tiểu thuyết dystopia nổi tiếng của George Orwell', 'uploads/anh30.jpg', 3),
(31, 'Bố già', 18, 'Tiểu thuyết', 25000.00, 140000.00, 2020, 'Tác phẩm nổi tiếng của Mario Puzo', 'uploads/anh31.jpg', 2),
(32, 'Đồi thỏ', 10, 'Phiêu lưu', 15000.00, 95000.00, 2018, 'Tác phẩm phiêu lưu của Richard Adams', 'uploads/anh32.jpg', 3),
(33, 'Nghệ thuật sống', 22, 'Kỹ năng sống', 12000.00, 80000.00, 2021, 'Sách kỹ năng sống hữu ích', 'uploads/anh33.jpg', 2),
(34, 'Tư duy nhanh và chậm', 14, 'Tiểu thuyết', 20000.00, 125000.00, 2020, 'Sách nổi tiếng của Daniel Kahneman', 'uploads/anh34.jpg', 2),
(35, 'Cha giàu cha nghèo', 30, 'Tiểu thuyết', 18000.00, 95000.00, 2019, 'Sách tài chính nổi tiếng của Robert Kiyosaki', 'uploads/anh35.jpg', 2),
(36, 'Dragon Ball Tập 1', 20, 'Truyện tranh', 8000.00, 35000.00, 2018, 'Cuộc phiêu lưu của Songoku và bạn bè', 'uploads/anh36.jpg', 4),
(37, 'One Piece Tập 1', 23, 'Truyện tranh', 9000.00, 40000.00, 2019, 'Hành trình tìm kho báu của Luffy', 'uploads/anh37.jpg', 4),
(38, 'Naruto Tập 1', 18, 'Truyện tranh', 8500.00, 38000.00, 2017, 'Câu chuyện về ninja Naruto', 'uploads/anh38.jpg', 4),
(39, 'Detective Conan Tập 1', 22, 'Truyện tranh', 9500.00, 42000.00, 2020, 'Thám tử nhí Conan phá án', 'uploads/anh39.jpg', 4),
(40, 'Attack on Titan Tập 4', 15, 'Truyện tranh', 10000.00, 45000.00, 2021, 'Cuộc chiến chống lại Titan', 'uploads/anh40.jpg', 4),
(41, 'Doraemon vol 2', 30, 'Truyện tranh', 7000.00, 30000.00, 2016, 'Chú mèo máy Doraemon và Nobita', 'uploads/anh41.jpg', 4),
(42, 'Bleach ', 13, 'Truyện tranh', 9500.00, 42000.00, 2018, 'Ichigo Kurosaki và thế giới Shinigami', 'uploads/anh42.jpg', 4),
(43, 'Fairy Tail Tập 1', 16, 'Truyện tranh', 9000.00, 40000.00, 2019, 'Hội pháp sư Fairy Tail', 'uploads/anh43.jpg', 4),
(44, 'My Hero Academia vol 26', 20, 'Truyện tranh', 10000.00, 45000.00, 2020, 'Câu chuyện về những siêu anh hùng trẻ tuổi', 'uploads/anh44.jpg', 4),
(45, 'Naruto Tập 26', 8, 'Truyện tranh', 24000.00, 67000.00, 2020, 'Câu chuyện về ninja Naruto', 'uploads/anh45.jpg', 4),
(46, 'Dragon Ball Tập 12', 22, 'Truyện tranh', 22000.00, 66000.00, 2020, 'Cuộc phiêu lưu của Songoku và bạn bè', 'uploads/anh46.jpg', 4),
(47, 'One Piece Tập 20', 25, 'Truyện tranh', 9000.00, 40000.00, 2021, 'Hành trình của Luffy và băng hải tặc Mũ Rơm', 'uploads/anh47.jpg', 4),
(49, 'Fairy Tail Tập 12', 24, 'Truyện tranh', 18000.00, 56000.00, 2021, '1', 'uploads/anh48.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `thue_sach`
--

CREATE TABLE `thue_sach` (
  `id_muon` int NOT NULL,
  `id_sach` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `ngay_muon` date DEFAULT NULL,
  `ngay_tra` date DEFAULT NULL,
  `trang_thai` varchar(20) DEFAULT 'đang thuê'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thue_sach`
--

INSERT INTO `thue_sach` (`id_muon`, `id_sach`, `id_user`, `ngay_muon`, `ngay_tra`, `trang_thai`) VALUES
(1, 1, 5, '2024-11-01', '2024-11-15', 'đã trả'),
(2, 2, 5, '2024-11-20', NULL, 'đang thuê'),
(3, 3, 6, '2024-11-05', '2024-11-19', 'đã trả'),
(4, 4, 6, '2024-11-25', NULL, 'đang thuê'),
(5, 5, 7, '2024-11-10', NULL, 'đang thuê'),
(7, 9, 1, '2025-12-25', '2026-01-01', 'đang thuê'),
(8, 5, 1, '2025-12-25', '2026-01-01', 'đang thuê'),
(9, 42, 7, '2025-12-25', '2026-01-01', 'đang thuê'),
(10, 37, 1, '2025-12-25', '2026-01-01', 'đang thuê'),
(11, 37, 1, '2025-12-25', '2026-01-01', 'đang thuê');

-- --------------------------------------------------------

--
-- Table structure for table `vai_tro`
--

CREATE TABLE `vai_tro` (
  `id` int NOT NULL,
  `ten_vai_tro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vai_tro`
--

INSERT INTO `vai_tro` (`id`, `ten_vai_tro`) VALUES
(1, 'Admin'),
(2, 'Quản lý'),
(3, 'Nhân viên'),
(4, 'Khách hàng VIP'),
(5, 'Khách hàng thường');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mua_sach`
--
ALTER TABLE `mua_sach`
  ADD PRIMARY KEY (`id_mua`),
  ADD KEY `id_sach` (`id_sach`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  ADD KEY `quoc_gia_id` (`quoc_gia_id`),
  ADD KEY `vai_tro_id` (`vai_tro_id`);

--
-- Indexes for table `quoc_gia`
--
ALTER TABLE `quoc_gia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`id_sach`),
  ADD KEY `quoc_gia_id` (`quoc_gia_id`);

--
-- Indexes for table `thue_sach`
--
ALTER TABLE `thue_sach`
  ADD PRIMARY KEY (`id_muon`),
  ADD KEY `id_sach` (`id_sach`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `vai_tro`
--
ALTER TABLE `vai_tro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mua_sach`
--
ALTER TABLE `mua_sach`
  MODIFY `id_mua` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quoc_gia`
--
ALTER TABLE `quoc_gia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `id_sach` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `thue_sach`
--
ALTER TABLE `thue_sach`
  MODIFY `id_muon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vai_tro`
--
ALTER TABLE `vai_tro`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mua_sach`
--
ALTER TABLE `mua_sach`
  ADD CONSTRAINT `mua_sach_ibfk_1` FOREIGN KEY (`id_sach`) REFERENCES `sach` (`id_sach`),
  ADD CONSTRAINT `mua_sach_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `nguoi_dung` (`id_user`);

--
-- Constraints for table `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD CONSTRAINT `nguoi_dung_ibfk_1` FOREIGN KEY (`quoc_gia_id`) REFERENCES `quoc_gia` (`id`),
  ADD CONSTRAINT `nguoi_dung_ibfk_2` FOREIGN KEY (`vai_tro_id`) REFERENCES `vai_tro` (`id`);

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`quoc_gia_id`) REFERENCES `quoc_gia` (`id`);

--
-- Constraints for table `thue_sach`
--
ALTER TABLE `thue_sach`
  ADD CONSTRAINT `thue_sach_ibfk_1` FOREIGN KEY (`id_sach`) REFERENCES `sach` (`id_sach`),
  ADD CONSTRAINT `thue_sach_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `nguoi_dung` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
