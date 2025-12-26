<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm sách</title>
    <script src="script.js"></script>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .warning {
            color: red;
            display: flex;
            justify-content: center;
        }

        form div {
            width: 65%;
            margin: auto;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <?php
    include("connect.php");
    
    // Chỉ admin mới được thêm
    if($_SESSION["vai_tro_id"] != 1 && $_SESSION["vai_tro_id"] != 2) {
        echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href='index.php';</script>";
        exit();
    }
    
    ob_start();
    ?>
    
    <div class="container">
        <form id="formThemSach" action="index.php?page_layout=themsach" method="post" enctype="multipart/form-data" onsubmit="return kiemTraForm('formThemSach')">
            <h1>Thêm sách</h1>
            
            <div>
                <input type="text" name="ten-sach" placeholder="Tên sách">
            </div>
            
            <div>
                <select name="the-loai">
                    <option value="">-- Chọn thể loại --</option>
                    <option value="Tiểu thuyết">Tiểu thuyết</option>
                    <option value="Thiếu nhi">Thiếu nhi</option>
                    <option value="Kỹ năng sống">Kỹ năng sống</option>
                    <option value="Phiêu lưu">Phiêu lưu</option>
                    <option value="Tâm lý">Tâm lý</option>
                    <option value="Trinh thám">Trinh thám</option>
                    <option value="Truyện tranh">Truyện tranh</option>
                    <option value="Sách giáo khoa">Sách giáo khoa</option>
                </select>
            </div>
            
            <div>
                <input type="number" name="so-luong" placeholder="Số lượng">
            </div>
            
            <div>
                <input type="number" name="gia-thue" placeholder="Giá thuê">
            </div>
            
            <div>
                <input type="number" name="gia-ban" placeholder="Giá bán">
            </div>
            
            <div>
                <input type="number" name="nam-xuat-ban" placeholder="Năm xuất bản">
            </div>
            
            <div>
                <input type="file" name="fileToUpload" placeholder="Ảnh bìa sách">
            </div>
            
            <div>
                <select name="quoc-gia">
                    <option value="">-- Chọn quốc gia --</option>
                    <?php
                    $sql = "SELECT * FROM quoc_gia";
                    $result = mysqli_query($conn, $sql);
                    while ($qg = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$qg['id']}'>{$qg['ten_quoc_gia']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <textarea id="mota" name="mo-ta" placeholder="Mô tả"></textarea>
                <small>Số ký tự: <span id="count">0</span></small>
            </div>
            
            <script>
                demKyTu('mota', 'count');
            </script>
            
            <div>
                <input type="submit" value="Thêm sách">
            </div>
        </form>
    </div>
    
    <?php
    if (!empty($_POST["ten-sach"]) &&
        !empty($_POST["the-loai"]) &&
        !empty($_POST["so-luong"]) &&
        !empty($_POST["gia-thue"]) &&
        !empty($_POST["gia-ban"]) &&
        !empty($_POST["nam-xuat-ban"]) &&
        !empty($_POST["quoc-gia"]) &&
        !empty($_POST["mo-ta"])
    ) {
        $tenSach = $_POST["ten-sach"];
        $theLoai = $_POST["the-loai"];
        $soLuong = $_POST["so-luong"];
        $giaThue = $_POST["gia-thue"];
        $giaBan = $_POST["gia-ban"];
        $namXB = $_POST["nam-xuat-ban"];
        $quocGia = $_POST["quoc-gia"];
        $moTa = $_POST["mo-ta"];
        
        // Xử lý ảnh
        $target_dir = "uploads/";
        
        // Kiểm tra thư mục uploads có tồn tại không
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Kiểm tra xem file ảnh có hợp lệ không
        if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] != "") {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "<p class='warning'>File không phải là ảnh.</p>";
                $uploadOk = 0;
            }
        } else {
            // Không có ảnh thì để NULL
            $target_file = NULL;
            $uploadOk = 2;
        }
        
        // Kiểm tra nếu file đã tồn tại
        if ($uploadOk == 1 && file_exists($target_file)) {
            echo "<p class='warning'>File này đã tồn tại trên hệ thống. Đã tự động sử dụng ảnh cũ.</p>";
            $uploadOk = 2;
        }
        
        // Kiểm tra kích thước file
        if ($uploadOk == 1 && $_FILES["fileToUpload"]["size"] > 5000000) {
            echo "<p class='warning'>File quá lớn (tối đa 5MB)</p>";
            $uploadOk = 0;
        }
        
        // Cho phép các định dạng file ảnh nhất định
        if($uploadOk == 1 && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "") {
            echo "<p class='warning'>Chỉ những file JPG, JPEG, PNG & GIF mới được chấp nhận.</p>";
            $uploadOk = 0;
        }
        
        // Xử lý upload
        if($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<p style='color: green; text-align: center;'>Upload ảnh thành công!</p>";
            } else {
                echo "<p class='warning'>Lỗi khi upload ảnh!</p>";
                $target_file = NULL;
            }
        }
        
        // Nếu $target_file là NULL, lưu NULL vào database
        if($target_file) {
            $sql = "INSERT INTO sach (ten_sach, so_luong, the_loai, gia_thue, gia_ban, nam_xuat_ban, mo_ta, anh_bia, quoc_gia_id)
                    VALUES ('$tenSach', '$soLuong', '$theLoai', '$giaThue', '$giaBan', '$namXB', '$moTa', '$target_file', '$quocGia')";
        } else {
            $sql = "INSERT INTO sach (ten_sach, so_luong, the_loai, gia_thue, gia_ban, nam_xuat_ban, mo_ta, anh_bia, quoc_gia_id)
                    VALUES ('$tenSach', '$soLuong', '$theLoai', '$giaThue', '$giaBan', '$namXB', '$moTa', NULL, '$quocGia')";
        }
        
        $result = mysqli_query($conn, $sql);
        header('location: index.php?page_layout=quanlysach');
        ob_end_flush();
    } else {
        echo "<p class='warning'>Vui lòng nhập đầy đủ thông tin!</p>";
    }
    ?>
</body>
</html>