<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thêm người dùng</title>
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
        
        input, select {
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
        <form action="index.php?page_layout=themnguoidung" method="post">
            <h1>Thêm người dùng</h1>
            
            <div>
                <input type="text" name="ten-dang-nhap" placeholder="Tên đăng nhập">
            </div>
            
            <div>
                <input id="matkhau" type="password" name="mat-khau" placeholder="Mật khẩu">
                <input type="checkbox" onclick="hienMatKhau('matkhau')"> Hiện mật khẩu
            </div>
            
            <div>
                <input type="text" name="ho-ten" placeholder="Họ tên">
            </div>
            
            <div>
                <input type="number" name="nam-sinh" placeholder="Năm sinh">
            </div>
            
            <div>
                <input type="text" name="sdt" placeholder="Số điện thoại">
            </div>
            
            <div>
                <input type="email" name="email" placeholder="Email">
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
                <select name="vai-tro">
                    <option value="">-- Chọn vai trò --</option>
                    <?php
                    $sql = "SELECT * FROM vai_tro";
                    $result = mysqli_query($conn, $sql);
                    while ($vt = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$vt['id']}'>{$vt['ten_vai_tro']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <input type="submit" value="Thêm người dùng">
            </div>
        </form>
    </div>
    
    <?php
    if (!empty($_POST["ten-dang-nhap"]) &&
        !empty($_POST["mat-khau"]) &&
        !empty($_POST["ho-ten"]) &&
        !empty($_POST["nam-sinh"]) &&
        !empty($_POST["sdt"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["quoc-gia"]) &&
        !empty($_POST["vai-tro"])
    ) {
        $tenDangNhap = $_POST["ten-dang-nhap"];
        $matKhau = $_POST["mat-khau"];
        $hoTen = $_POST["ho-ten"];
        $namSinh = $_POST["nam-sinh"];
        $sdt = $_POST["sdt"];
        $email = $_POST["email"];
        $quocGia = $_POST["quoc-gia"];
        $vaiTro = $_POST["vai-tro"];
        
        $sql = "INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ten, nam_sinh, sdt, email, quoc_gia_id, vai_tro_id)
                VALUES ('$tenDangNhap', '$matKhau', '$hoTen', '$namSinh', '$sdt', '$email', '$quocGia', '$vaiTro')";
        
        $result = mysqli_query($conn, $sql);
        header('location: index.php?page_layout=nguoidung');
        ob_end_flush();
    } else {
        echo "<p class='warning'>Vui lòng nhập đầy đủ thông tin!</p>";
    }
    ?>
</body>
</html>