-- TẠO DATABASE
CREATE DATABASE IF NOT EXISTS quan_ly_thu_vien;
USE quan_ly_thu_vien;

-- 1. Bảng vai_tro
CREATE TABLE IF NOT EXISTS vai_tro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_vai_tro VARCHAR(50) NOT NULL
);

-- 2. Bảng quoc_gia
CREATE TABLE IF NOT EXISTS quoc_gia (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_quoc_gia VARCHAR(100) NOT NULL
);

-- 3. Bảng sach
CREATE TABLE IF NOT EXISTS sach (
    id_sach INT PRIMARY KEY AUTO_INCREMENT,
    ten_sach VARCHAR(255) NOT NULL,
    anh_bia VARCHAR(255),
    so_luong INT DEFAULT 0,
    the_loai VARCHAR(100),
    gia_thue DECIMAL(10,2),
    gia_ban DECIMAL(10,2),
    nam_xuat_ban INT,
    mo_ta TEXT,
    quoc_gia_id INT,
    FOREIGN KEY (quoc_gia_id) REFERENCES quoc_gia(id)
);

-- 4. Bảng nguoi_dung
CREATE TABLE IF NOT EXISTS nguoi_dung (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    ten_dang_nhap VARCHAR(50) NOT NULL UNIQUE,
    mat_khau VARCHAR(255) NOT NULL,
    ten VARCHAR(100) NOT NULL,
    nam_sinh INT,
    sdt VARCHAR(15),
    email VARCHAR(100),
    quoc_gia_id INT,
    vai_tro_id INT,
    FOREIGN KEY (quoc_gia_id) REFERENCES quoc_gia(id),
    FOREIGN KEY (vai_tro_id) REFERENCES vai_tro(id)
);

-- 5. Bảng thue_sach
CREATE TABLE IF NOT EXISTS thue_sach (
    id_muon INT PRIMARY KEY AUTO_INCREMENT,
    id_sach INT,
    id_user INT,
    ngay_muon DATE,
    ngay_tra DATE,
    trang_thai VARCHAR(20) DEFAULT 'đang thuê',
    FOREIGN KEY (id_sach) REFERENCES sach(id_sach),
    FOREIGN KEY (id_user) REFERENCES nguoi_dung(id_user)
);

-- INSERT DỮ LIỆU MẪU

-- Vai trò
INSERT INTO vai_tro (ten_vai_tro) VALUES
('Admin'),
('Quản lý'),
('Nhân viên'),
('Khách hàng VIP'),
('Khách hàng thường');

-- Quốc gia
INSERT INTO quoc_gia (ten_quoc_gia) VALUES
('Việt Nam'),
('Mỹ'),
('Anh'),
('Nhật Bản'),
('Hàn Quốc'),
('Trung Quốc'),
('Pháp'),
('Đức'),
('Nga'),
('Ấn Độ');

-- Sách
INSERT INTO sach (ten_sach, anh_bia, so_luong, the_loai, gia_thue, gia_ban, nam_xuat_ban, mo_ta, quoc_gia_id) VALUES
('Mắt biếc', 'uploads/anh1.jpg', 15, 'Tiểu thuyết', 15000, 89000, 2020, 'Truyện tình cảm động của Nguyễn Nhật Ánh', 1),
('Tôi thấy hoa vàng trên cỏ xanh', 'uploads/anh2.jpg', 20, 'Tiểu thuyết', 18000, 95000, 2019, 'Câu chuyện tuổi thơ miền quê', 1),
('Dế Mèn phiêu lưu ký', 'uploads/anh3.jpg', 25, 'Thiếu nhi', 10000, 68000, 2021, 'Tác phẩm văn học thiếu nhi kinh điển', 1),
('Đắc nhân tâm', 'uploads/anh4.jpg', 30, 'Kỹ năng sống', 20000, 89000, 2022, 'Nghệ thuật thu phục lòng người', 2),
('Nhà giả kim', 'uploads/anh5.jpg', 18, 'Tiểu thuyết', 15000, 79000, 2020, 'Hành trình tìm kiếm giấc mơ', 7),
('Harry Potter và Hòn đá phù thủy', 'uploads/anh6.jpg', 12, 'Phiêu lưu', 25000, 149000, 2019, 'Phần 1 của series Harry Potter', 3),
('1Q84', 'uploads/anh7.jpg', 10, 'Tiểu thuyết', 30000, 279000, 2021, 'Tiểu thuyết siêu thực Nhật Bản', 4),
('Trăm năm cô đơn', 'uploads/anh8.jpg', 8, 'Tiểu thuyết', 25000, 159000, 2020, 'Hiện thực huyền ảo độc đáo', 7),
('Ông già và biển cả', 'uploads/anh9.jpg', 20, 'Tiểu thuyết', 12000, 59000, 2021, 'Câu chuyện về sự kiên trì', 2),
('Tội ác và hình phạt', 'uploads/anh10.jpg', 15, 'Tâm lý', 28000, 189000, 2019, 'Tác phẩm tâm lý tội phạm nổi tiếng', 9);

-- Người dùng
INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ten, nam_sinh, sdt, email, quoc_gia_id, vai_tro_id) VALUES
('admin', '123456', 'Nguyễn Văn Admin', 1990, '0901234567', 'admin@library.vn', 1, 1),
('manager1', '123456', 'Trần Thị Quản Lý', 1985, '0902345678', 'manager@library.vn', 1, 2),
('staff1', '123456', 'Lê Văn Nhân Viên', 1995, '0903456789', 'staff1@library.vn', 1, 3),
('vip1', '123456', 'Phạm Thị VIP', 1992, '0904567890', 'vip1@gmail.com', 1, 4),
('user1', '123456', 'Hoàng Văn A', 1998, '0905678901', 'user1@gmail.com', 1, 5),
('user2', '123456', 'Đỗ Thị B', 2000, '0906789012', 'user2@gmail.com', 1, 5),
('user3', '123456', 'Vũ Văn C', 1997, '0907890123', 'user3@gmail.com', 1, 5);

-- Thuê sách
INSERT INTO thue_sach (id_sach, id_user, ngay_muon, ngay_tra, trang_thai) VALUES
(1, 5, '2024-11-01', '2024-11-15', 'đã trả'),
(2, 5, '2024-11-20', NULL, 'đang thuê'),
(3, 6, '2024-11-05', '2024-11-19', 'đã trả'),
(4, 6, '2024-11-25', NULL, 'đang thuê'),
(5, 7, '2024-11-10', NULL, 'đang thuê');

bạn có đọc và hiểu nội dung trong file trên không? Vui lòng xác nhận!