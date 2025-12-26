<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật người dùng</title>
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
    
    // Chỉ admin mới được sửa
    if($_SESSION["vai_tro_id"] != 1 && $_SESSION["vai_tro_id"] != 2) {
        echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href='index.php';</script>";
        exit();
    }
    
    ob_start();
    
    $id = $_GET["id"];
    $sql = "SELECT * FROM nguoi_dung WHERE id_user = '$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    ?>
    
    <div class="container">
        <form action="index.php?page_layout=capnhatnguoidung&id=<?php echo $user["id_user"] ?>" method="post">
            <h1>Cập nhật người dùng</h1>
            
            <div>
                <input type="text" name="ten-dang-nhap" value="<?php echo $user['ten_dang_nhap'] ?>" readonly>
            </div>
            
            <div>
                <input id="matkhau" type="password" name="mat-khau" placeholder="Mật khẩu mới (để trống nếu không đổi)">
                <input type="checkbox" onclick="hienMatKhau('matkhau')"> Hiện mật khẩu
            </div>
            
            <div>
                <input type="text" name="ho-ten" value="<?php echo $user['ten'] ?>">
            </div>
            
            <div>
                <input type="number" name="nam-sinh" value="<?php echo $user['nam_sinh'] ?>">
            </div>
            
            <div>
                <input type="text" name="sdt" value="<?php echo $user['sdt'] ?>">
            </div>
            
            <div>
                <input type="email" name="email" value="<?php echo $user['email'] ?>">
            </div>
            
            <div>
                <select name="quoc-gia">
                    <?php
                    $sql_qg = "SELECT * FROM quoc_gia";
                    $result_qg = mysqli_query($conn, $sql_qg);
                    while ($qg = mysqli_fetch_assoc($result_qg)) {
                        $selected = ($user['quoc_gia_id'] == $qg['id']) ? 'selected' : '';
                        echo "<option value='{$qg['id']}' $selected>{$qg['ten_quoc_gia']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <select name="vai-tro">
                    <?php
                    $sql_vt = "SELECT * FROM vai_tro";
                    $result_vt = mysqli_query($conn, $sql_vt);
                    while ($vt = mysqli_fetch_assoc($result_vt)) {
                        $selected = ($user['vai_tro_id'] == $vt['id']) ? 'selected' : '';
                        echo "<option value='{$vt['id']}' $selected>{$vt['ten_vai_tro']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <input type="submit" value="Cập nhật">
            </div>
        </form>
    </div>
    
    <?php
    if (!empty($_POST["ho-ten"]) &&
        !empty($_POST["nam-sinh"]) &&
        !empty($_POST["sdt"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["quoc-gia"]) &&
        !empty($_POST["vai-tro"])
    ) {
        $hoTen = $_POST["ho-ten"];
        $namSinh = $_POST["nam-sinh"];
        $sdt = $_POST["sdt"];
        $email = $_POST["email"];
        $quocGia = $_POST["quoc-gia"];
        $vaiTro = $_POST["vai-tro"];
        
        if (!empty($_POST["mat-khau"])) {
            $matKhau = $_POST["mat-khau"];
            $sql = "UPDATE nguoi_dung SET 
                    mat_khau='$matKhau',
                    ten='$hoTen',
                    nam_sinh='$namSinh',
                    sdt='$sdt',
                    email='$email',
                    quoc_gia_id='$quocGia',
                    vai_tro_id='$vaiTro'
                    WHERE id_user='$id'";
        } else {
            $sql = "UPDATE nguoi_dung SET 
                    ten='$hoTen',
                    nam_sinh='$namSinh',
                    sdt='$sdt',
                    email='$email',
                    quoc_gia_id='$quocGia',
                    vai_tro_id='$vaiTro'
                    WHERE id_user='$id'";
        }
        
        mysqli_query($conn, $sql);
        header('location: index.php?page_layout=nguoidung');
        ob_end_flush();
    }
    ?>
</body>
</html>