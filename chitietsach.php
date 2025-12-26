<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .return a{
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
     <?php
    include("connect.php");
    $id = (int)$_GET['id_sach'];   
    $stmt = $conn->prepare("SELECT s.*, q.ten_quoc_gia FROM sach s LEFT JOIN quoc_gia q ON s.quoc_gia_id = q.id WHERE s.id_sach = ?"); 
    $stmt->bind_param("i", $id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    $book = $result->fetch_assoc();    
    ?>


  <div class="chi-tiet">
    <div class="return">
            <a href="index.php?page_layout=trangchu">Quay lại</a>
    </div>
    <div class="chi-tiet-sach">
        
        <div class="chi-tiet-anh">
            <img width="225px" height="325px" src="<?php echo htmlspecialchars($book['anh_bia']); ?>" alt="">
        </div>
        <div class="chi-tiet-thong-tin">
            <h2>Tiêu đề: <?php echo htmlspecialchars($book['ten_sach']); ?></h2>
            <p>Thể loại: <?php echo htmlspecialchars($book['the_loai']); ?></p>
            <p>năm xuất bản: <?php echo htmlspecialchars($book['nam_xuat_ban']); ?></p>
            <p>quốc gia: <?php echo htmlspecialchars($book['ten_quoc_gia']); ?></p>
            <p>giá bán: <?php echo htmlspecialchars($book['gia_ban']); ?></p>
            <p>giá thuê: <?php echo htmlspecialchars($book['gia_thue']); ?></p>
            <p>Mô tả: <?php echo htmlspecialchars($book['mo_ta']); ?></p>
            <div class="tinh-nang">
                <a href="index.php?page_layout=muonsach&id_sach= <?php echo $id ?>">Mượn sách</a>
                <a href="index.php?page_layout=muasach&id_sach= <?php echo $id ?>">mua sách</a>
            </div>            
        </div>

    </div>
  </div>

  <script src="script1.js"></script>
<script src="script3.js"></script>

</body>
</html>