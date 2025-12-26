
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Sách thể loại: <?php echo htmlspecialchars($theLoai); ?></title>
  <style>
    body { 
        font-family: Arial; 
        background: #f7f8fa;
         margin: 0; 
    }
    h1 { 
        text-align: center; 
        padding: 20px; 
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 16px;
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
    }
    .card {
      background: #fff; border: 1px solid #ddd; border-radius: 8px;
      text-align: center; padding: 10px;
    }
    .card img {
      width: 100%; height: 240px; object-fit: cover;
      border-radius: 6px; background: #eee;
    }
    .title {
         margin-top: 8px; 
         font-weight: bold; 
         font-size: 15px; 
    }
    .card a { 
        text-decoration: none; 
        color: inherit; 
        display: block; 
    }
    .navigation {
        font-size: 20px;
        text-align: center; 
        margin-bottom: 20px; 
        padding: 1px;
    }
    p{
        text-align: center; 
        font-size: 18px;
    }
    .no-books {
        grid-column: 1 / -1; 
        background: #fff; 
        padding: 20px; 
        border: 1px solid #ddd; 
        border-radius: 8px;
    }
  </style>
</head>
<body>
    <?php
        include("connect.php");
        $theLoai = isset($_GET['the_loai']) ? trim($_GET['the_loai']) : '';

        if ($theLoai === '') {
            die("Không có thể loại được chọn.");
        }

        $stmt = $conn->prepare("SELECT id_sach, ten_sach, anh_bia  FROM sach WHERE the_loai = ?");
        $stmt->bind_param("s", $theLoai);
        $stmt->execute();
        $result = $stmt->get_result();

        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    ?>

<h1>📚 Thể loại: <?php echo htmlspecialchars($theLoai); ?></h1>
    <div class="navigation">
        <a href="index.php?page_layout=trangchu">Quay lại</a>
    </div>
<div class="grid">

  <?php if (empty($books)): ?>
    <div class="no-books">
        <p>Không có sách nào thuộc thể loại này.</p>
    </div>
  <?php else: ?>
    <?php foreach ($books as $b): ?>
      <div class="card">
        <a href="index.php?page_layout=chitietsach&id_sach= <?php echo $b['id_sach']; ?>">
          <img src="<?php echo htmlspecialchars($b['anh_bia']); ?>"
               alt="<?php echo htmlspecialchars($b['ten_sach']); ?>"
               onerror="this.src='uploads/placeholder.jpg'">
          <div class="title"><?php echo htmlspecialchars($b['ten_sach']); ?></div>
        </a>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

</body>
</html>

</body>
</html>