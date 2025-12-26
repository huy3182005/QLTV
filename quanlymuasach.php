<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mua sách</title>
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
        <h1>Quản lý mua sách</h1>
        <div>
            <input type="text" id="timkiem" onkeyup="timKiemTable()" placeholder="Tìm kiếm..." style="padding: 5px; margin-right: 10px;">
        </div>
    </div>

    <table id="myTable">
        <tr>
            <th>Mã mua</th>
            <th>Tên sách</th>
            <th>Người mua</th>
            <th>SĐT</th>
            <th>Ngày mua</th>
        </tr>

        <?php 
        // Admin thấy tất cả, User chỉ thấy của mình
        if($isAdmin) {
            $sql = "SELECT ms.*, s.ten_sach, nd.ten, nd.sdt
                    FROM mua_sach ms
                    JOIN sach s ON ms.id_sach = s.id_sach
                    JOIN nguoi_dung nd ON ms.id_user = nd.id_user
                    ORDER BY ms.ngay_mua DESC";
        } else {
            $sql = "SELECT ms.*, s.ten_sach, nd.ten, nd.sdt
                    FROM mua_sach ms
                    JOIN sach s ON ms.id_sach = s.id_sach
                    JOIN nguoi_dung nd ON ms.id_user = nd.id_user
                    WHERE ms.id_user = '$my_id'
                    ORDER BY ms.ngay_mua DESC";
        }
        
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row['id_mua']; ?></td>
            <td><?php echo $row['ten_sach']; ?></td>
            <td><?php echo $row['ten']; ?></td>
            <td><?php echo $row['sdt']; ?></td>
            <td><?php echo $row['ngay_mua']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>