<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        .container {
            width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 5px;
        }
        
        h1 {
            text-align: center;
        }
        
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
        }
        
        .warning {
            color: red;
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
        <form action="login.php" method="post">
            <h1>Đăng nhập</h1>
            <div>
                <input type="text" name="username" placeholder="Tên đăng nhập">
            </div>
            <div>
                <input type="password" name="password" placeholder="Mật khẩu">
            </div>
            <div>
                <input type="submit" value="Đăng nhập">
            </div>
            
            <div class="link">
                <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a></p>
            </div>
        </form>
        
        <?php
        include("connect.php");
        
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $tenDangNhap = $_POST['username'];
            $matKhau = $_POST['password'];
            
            $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = '$tenDangNhap' AND mat_khau = '$matKhau'";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION["username"] = $tenDangNhap;
                $_SESSION["vai_tro_id"] = $user['vai_tro_id'];
                header('location: index.php');
            } else {
                echo "<p class='warning'>Sai thông tin đăng nhập</p>";
            }
        }
        ?>
    </div>
</body>
</html>