<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 5px;
        }
        
        h1 {
            text-align: center;
        }
        
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
        }
        
        .warning {
            color: red;
            text-align: center;
        }
        
        .success {
            color: green;
            text-align: center;
        }
        
        .link {
            text-align: center;
            margin-top: 15px;
        }
        
        .link a {
            color: blue;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="dangky.php" method="post">
            <h1>Đăng ký tài khoản</h1>
            
            <div>
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
            </div>
            
            <div>
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            
            <div>
                <input type="password" name="password2" placeholder="Nhập lại mật khẩu" required>
            </div>
            
            <div>
                <input type="text" name="hoten" placeholder="Họ tên" required>
            </div>
            
            <div>
                <input type="number" name="namsinh" placeholder="Năm sinh" required>
            </div>
            
            <div>
                <input type="text" name="sdt" placeholder="Số điện thoại" required>
            </div>
            
            <div>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            
            <div>
                <select name="quocgia" required>
                    <option value="">-- Chọn quốc gia --</option>
                    <?php
                    include("connect.php");
                    $sql = "SELECT * FROM quoc_gia";
                    $result = mysqli_query($conn, $sql);
                    while ($qg = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$qg['id']}'>{$qg['ten_quoc_gia']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <input type="submit" value="Đăng ký">
            </div>
            
            <div class="link">
                <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
            </div>
        </form>
        
        <?php
        if (isset($_POST['username']) && 
            isset($_POST['password']) && 
            isset($_POST['password2']) &&
            isset($_POST['hoten']) &&
            isset($_POST['namsinh']) &&
            isset($_POST['sdt']) &&
            isset($_POST['email']) &&
            isset($_POST['quocgia'])
        ) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $hoten = $_POST['hoten'];
            $namsinh = $_POST['namsinh'];
            $sdt = $_POST['sdt'];
            $email = $_POST['email'];
            $quocgia = $_POST['quocgia'];
            
            // Kiểm tra mật khẩu khớp
            if ($password != $password2) {
                echo "<p class='warning'>Mật khẩu không khớp!</p>";
            } else {
                // Kiểm tra username đã tồn tại
                $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = '$username'";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    echo "<p class='warning'>Tên đăng nhập đã tồn tại!</p>";
                } else {
                    // Thêm người dùng mới với vai trò 5 (Khách hàng thường)
                    $sql = "INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ten, nam_sinh, sdt, email, quoc_gia_id, vai_tro_id)
                            VALUES ('$username', '$password', '$hoten', '$namsinh', '$sdt', '$email', '$quocgia', 5)";
                    
                    if (mysqli_query($conn, $sql)) {
                        echo "<p class='success'>Đăng ký thành công! Đang chuyển đến trang đăng nhập...</p>";
                        header('refresh:2;url=login.php');
                    } else {
                        echo "<p class='warning'>Lỗi: " . mysqli_error($conn) . "</p>";
                    }
                }
            }
        }
        ?>
    </div>
</body>
</html>