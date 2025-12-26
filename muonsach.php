<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container{
            background-color:rgba(224, 223, 223, 1);
            width: 300px;
            height:450px;
            margin:auto;
            padding: 1px 5px 1px 5px;
            border-radius:36px;

            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content:center;
        }
        .header {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        h4{
            font-size:18px;
        }
        .gia-thue{
            display: flex;
            justify-content: center;
            background: #e1e732ff; 
            padding: 1px; 
            border-radius: 16px;
        }
        .ngay-muon, .ngay-tra{
            display: flex;
        }

        #dieu-chinh{
            margin: 10px 5px 10px 5px;
            padding: 1px;
            border-radius: 8px;
        }
        .submit-btn{
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }
        .return a{
            text-decoration: none;
            color: blue;
            
        }
    </style>
</head>
<body>


    <?php
    include("connect.php");
    ob_start();
    $id = (int)$_GET['id_sach'];
    $stmt = $conn->prepare("SELECT s.*, q.ten_quoc_gia FROM sach s LEFT JOIN quoc_gia q ON s.quoc_gia_id = q.id WHERE s.id_sach = ?"); 
    $stmt->bind_param("i", $id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    $book = $result->fetch_assoc();    
    ?>

    <div class="container">
        <div class="return">
            <a href="index.php?page_layout=chitietsach&id_sach=<?php echo $id; ?>">Quay lại</a>
        </div>
        <form action="index.php?page_layout=muonsach"  method="post">
            <div class="header">
                <h1>Thuê sách</h1>                
            </div>

            <div >
                <h4>Tiêu đề: <?php echo htmlspecialchars($book['ten_sach']); ?></h4>
            </div>
            <div class="gia-thue">
                <p>Giá thuê: <span id="gia-thue"><?php echo htmlspecialchars($book['gia_thue']); ?></span>  VNĐ</p>
            </div>
            <div class="ngay-muon">
                <p>Ngày mượn</p>
                <input type="date" id="dieu-chinh" name="ngay-muon" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="ngay-tra">
                <p>Ngày trả</p>
                <input type="date" id="dieu-chinh" name="ngay-tra" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
            </div>
            <input type="hidden" name="id-sach" value="<?php echo (int)$book['id_sach']; ?>">
            <div class="submit-btn">
                <input type="submit" value="Thuê sách">
            </div>
        </form>
    <?php
    if (!empty($_POST["id-sach"]) && !empty($_POST["ngay-muon"])) {
        $idSach = $_POST["id-sach"];
        $ngayMuon = $_POST["ngay-muon"];
        $ngayTra = $_POST["ngay-tra"];
        
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
        
        $sql = "INSERT INTO thue_sach (id_sach, id_user, ngay_muon, ngay_tra, trang_thai)
                VALUES ('$idSach', '$idUser', '$ngayMuon', '$ngayTra', 'đang thuê')";
        
        $result = mysqli_query($conn, $sql);
        
        $sql_update = "UPDATE sach SET so_luong = so_luong - 1 WHERE id_sach = '$idSach'";
        mysqli_query($conn, $sql_update);
        
        header('location: index.php?page_layout=thuesach');
        ob_end_flush();
    } else {
        echo "<p class='warning'>Vui lòng nhập đầy đủ thông tin!</p>";
    }
    ?>
    </div>
    <script src="script1.js"></script>
</body>
</html>