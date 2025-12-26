<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sách</title>
    <script src="script.js"></script>
    <style>
        table {
            margin: 0 auto;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .xoa {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
        
        .sua {
            color: blue;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }

        .them {
            color: green;
            font-weight: bold;
            background-color: #f0f234;
            padding: 5px 10px;
            text-decoration: none;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
    
    // Chỉ admin mới vào được
    if($_SESSION["vai_tro_id"] != 1 && $_SESSION["vai_tro_id"] != 2) {
        echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href='index.php';</script>";
        exit();
    }
    ?>
    
    <div class="header">
        <h1>Quản lý sách (Admin)</h1>
        <div>
            <input type="text" id="timkiem" onkeyup="timKiemTable()" placeholder="Tìm kiếm..." style="padding: 5px; margin-right: 10px;">
            <a class="them" href="index.php?page_layout=themsach">Thêm sách</a>
        </div>
    </div>

    <table id="myTable">
        <tr>
            <th>ID</th>
            <th>Ảnh bìa</th>
            <th>Tên sách</th>
            <th>Thể loại</th>
            <th>Số lượng</th>
            <th>Giá thuê</th>
            <th>Giá bán</th>
            <th>Năm XB</th>
            <th>Quốc gia</th>
            <th>Chức năng</th>
        </tr>

        <?php 
        include "connect.php";
        
        $sql = "SELECT s.*, q.ten_quoc_gia FROM sach s 
                LEFT JOIN quoc_gia q ON s.quoc_gia_id = q.id
                ORDER BY s.id_sach DESC"; 
        
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['id_sach']; ?></td>
            <td>
                <?php if(!empty($row['anh_bia']) && file_exists($row['anh_bia'])) { ?>
                    <img src="<?php echo $row['anh_bia']; ?>" width="100" height="150" style="object-fit: cover;">
                <?php } else { ?>
                    <span style="color: #999;">Chưa có ảnh</span>
                <?php } ?>
            </td>
            <td><?php echo $row['ten_sach']; ?></td>
            <td><?php echo $row['the_loai']; ?></td>
            <td><?php echo $row['so_luong']; ?></td>
            <td><?php echo $row['gia_thue']; ?></td>
            <td><?php echo $row['gia_ban']; ?></td>
            <td><?php echo $row['nam_xuat_ban']; ?></td>
            <td><?php echo $row['ten_quoc_gia']; ?></td>
            <td>
                <a class="sua" href="index.php?page_layout=capnhatsach&id=<?php echo $row['id_sach']; ?>">Sửa</a>
                <a class="xoa" href="xoasach.php?id=<?php echo $row['id_sach']; ?>" onclick="return xacNhanXoa('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>