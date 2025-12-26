<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thuê sách</title>
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
    ob_start();
    
    $isAdmin = ($_SESSION["vai_tro_id"] == 1 || $_SESSION["vai_tro_id"] == 2);
    ?>
    
    <div class="container">
        <form action="index.php?page_layout=themthue" method="post">
            <h1>Thuê sách</h1>
            
            <div>
                <select id="sach-select" name="id-sach" onchange="tinhTongTien()">
                    <option value="">-- Chọn sách --</option>
                    <?php
                    $sql = "SELECT * FROM sach WHERE so_luong > 0";
                    $result = mysqli_query($conn, $sql);
                    while ($sach = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$sach['id_sach']}' data-gia='{$sach['gia_thue']}'>{$sach['ten_sach']} (Còn: {$sach['so_luong']})</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div style="background: #f0f0f0; padding: 10px; margin: 10px 0;">
                <p>Giá thuê: <span id="gia-thue">0</span> VNĐ</p>
            </div>
            
            <?php if($isAdmin) { ?>
                <div>
                    <select name="id-user">
                        <option value="">-- Chọn người thuê --</option>
                        <?php
                        $sql = "SELECT * FROM nguoi_dung WHERE vai_tro_id IN (4, 5)";
                        $result = mysqli_query($conn, $sql);
                        while ($user = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$user['id_user']}'>{$user['ten']} - {$user['sdt']}</option>";
                        }
                        ?>
                    </select>
                </div>
            <?php } ?>
            
            <div>
                <input type="date" name="ngay-muon" value="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div>
                <input type="submit" value="Thuê sách">
            </div>
        </form>
    </div>
    
    <?php
    if (!empty($_POST["id-sach"]) && !empty($_POST["ngay-muon"])) {
        $idSach = $_POST["id-sach"];
        $ngayMuon = $_POST["ngay-muon"];
        
        $isAdmin = ($_SESSION["vai_tro_id"] == 1 || $_SESSION["vai_tro_id"] == 2);
        
        // Admin chọn người thuê, User thuê cho chính mình
        if($isAdmin && !empty($_POST["id-user"])) {
            $idUser = $_POST["id-user"];
        } else {
            // Lấy id của người đang đăng nhập
            $username = $_SESSION["username"];
            $sql_user = "SELECT id_user FROM nguoi_dung WHERE ten_dang_nhap = '$username'";
            $result_user = mysqli_query($conn, $sql_user);
            $user_data = mysqli_fetch_assoc($result_user);
            $idUser = $user_data['id_user'];
        }
        
        $sql = "INSERT INTO thue_sach (id_sach, id_user, ngay_muon, trang_thai)
                VALUES ('$idSach', '$idUser', '$ngayMuon', 'đang thuê')";
        
        $result = mysqli_query($conn, $sql);
        
        $sql_update = "UPDATE sach SET so_luong = so_luong - 1 WHERE id_sach = '$idSach'";
        mysqli_query($conn, $sql_update);
        
        header('location: index.php?page_layout=thuesach');
        ob_end_flush();
    } else {
        echo "<p class='warning'>Vui lòng nhập đầy đủ thông tin!</p>";
    }
    ?>
</body>
</html>