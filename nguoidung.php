<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Người dùng</title>
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
    
    // Chỉ admin mới xem được
    if($_SESSION["vai_tro_id"] != 1 && $_SESSION["vai_tro_id"] != 2) {
        echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href='index.php';</script>";
        exit();
    }
    ?>
    
    <div class="header">
        <h1>Quản lý người dùng</h1>
        <div>
            <input type="text" id="timkiem" onkeyup="timKiemTable()" placeholder="Tìm kiếm..." style="padding: 5px; margin-right: 10px;">
            <a class="them" href="index.php?page_layout=themnguoidung">Thêm người dùng</a>
        </div>
    </div>

    <table id="myTable">
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Họ tên</th>
            <th>Năm sinh</th>
            <th>SĐT</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Chức năng</th>
        </tr>

        <?php 
        include "connect.php";
        
        $sql = "SELECT nd.*, vt.ten_vai_tro
                FROM nguoi_dung nd
                LEFT JOIN vai_tro vt ON nd.vai_tro_id = vt.id
                ORDER BY nd.id_user DESC"; 
        
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['id_user']; ?></td>
            <td><?php echo $row['ten_dang_nhap']; ?></td>
            <td><?php echo $row['ten']; ?></td>
            <td><?php echo $row['nam_sinh']; ?></td>
            <td><?php echo $row['sdt']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['ten_vai_tro']; ?></td>
            <td>
                <a class="sua" href="index.php?page_layout=capnhatnguoidung&id=<?php echo $row['id_user']; ?>">Sửa</a>
                <a class="xoa" href="xoanguoidung.php?id=<?php echo $row['id_user']; ?>" onclick="return xacNhanXoa('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>