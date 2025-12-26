<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thuê sách</title>
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
    $isAdmin = ($_SESSION["vai_tro_id"] == 1 || $_SESSION["vai_tro_id"] == 2);
    
    // Lấy id user hiện tại
    include "connect.php";
    $username = $_SESSION["username"];
    $sql_user = "SELECT id_user FROM nguoi_dung WHERE ten_dang_nhap = '$username'";
    $result_user = mysqli_query($conn, $sql_user);
    $user_data = mysqli_fetch_assoc($result_user);
    $my_id = $user_data['id_user'];
    ?>
    
    <div class="header">
        <h1>Quản lý thuê sách</h1>
        <div>
            <input type="text" id="timkiem" onkeyup="timKiemTable()" placeholder="Tìm kiếm..." style="padding: 5px; margin-right: 10px;">
            <a class="them" href="index.php?page_layout=themthue">Thuê sách</a>
        </div>
    </div>

    <table id="myTable">
        <tr>
            <th>Mã thuê</th>
            <th>Tên sách</th>
            <th>Người thuê</th>
            <th>SĐT</th>
            <th>Ngày mượn</th>
            <th>Ngày trả</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>

        <?php 
        // Admin thấy tất cả, User chỉ thấy của mình
        if($isAdmin) {
            $sql = "SELECT ts.*, s.ten_sach, nd.ten, nd.sdt
                    FROM thue_sach ts
                    JOIN sach s ON ts.id_sach = s.id_sach
                    JOIN nguoi_dung nd ON ts.id_user = nd.id_user
                    ORDER BY ts.ngay_muon DESC";
        } else {
            $sql = "SELECT ts.*, s.ten_sach, nd.ten, nd.sdt
                    FROM thue_sach ts
                    JOIN sach s ON ts.id_sach = s.id_sach
                    JOIN nguoi_dung nd ON ts.id_user = nd.id_user
                    WHERE ts.id_user = '$my_id'
                    ORDER BY ts.ngay_muon DESC";
        }
        
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['id_muon']; ?></td>
            <td><?php echo $row['ten_sach']; ?></td>
            <td><?php echo $row['ten']; ?></td>
            <td><?php echo $row['sdt']; ?></td>
            <td><?php echo $row['ngay_muon']; ?></td>
            <td><?php echo $row['ngay_tra']; ?></td>
            <td><?php echo $row['trang_thai']; ?></td>
            <td>
                <?php 
                // Admin hoặc người thuê mới được trả/xóa
                if($isAdmin || $row['id_user'] == $my_id) {
                ?>
                    <?php if($row['trang_thai'] == 'đang thuê') { ?>
                        <a class="sua" href="trasach.php?id=<?php echo $row['id_muon']; ?>" onclick="return xacNhanXoa('Xác nhận trả sách?')">Trả sách</a>
                    <?php } ?>
                    <a class="xoa" href="xoathue.php?id=<?php echo $row['id_muon']; ?>" onclick="return xacNhanXoa('Bạn có chắc muốn xóa?')">Xóa</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>