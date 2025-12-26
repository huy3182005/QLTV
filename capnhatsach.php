<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật sách</title>
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
        
        input, select, textarea {
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
    $sql = "SELECT * FROM sach WHERE id_sach = '$id'";
    $result = mysqli_query($conn, $sql);
    $sach = mysqli_fetch_assoc($result);
    ?>
    
    <div class="container">
        <form action="index.php?page_layout=capnhatsach&id=<?php echo $sach["id_sach"] ?>" method="post" enctype="multipart/form-data">
            <h1>Cập nhật sách</h1>
            
            <div>
                <input type="text" name="ten-sach" value="<?php echo $sach['ten_sach'] ?>">
            </div>
            
            <div>
                <select name="the-loai">
                    <option value="Tiểu thuyết" <?php echo ($sach['the_loai'] == 'Tiểu thuyết') ? 'selected' : ''; ?>>Tiểu thuyết</option>
                    <option value="Thiếu nhi" <?php echo ($sach['the_loai'] == 'Thiếu nhi') ? 'selected' : ''; ?>>Thiếu nhi</option>
                    <option value="Kỹ năng sống" <?php echo ($sach['the_loai'] == 'Kỹ năng sống') ? 'selected' : ''; ?>>Kỹ năng sống</option>
                    <option value="Phiêu lưu" <?php echo ($sach['the_loai'] == 'Phiêu lưu') ? 'selected' : ''; ?>>Phiêu lưu</option>
                    <option value="Tâm lý" <?php echo ($sach['the_loai'] == 'Tâm lý') ? 'selected' : ''; ?>>Tâm lý</option>
                    <option value="Trinh thám" <?php echo ($sach['the_loai'] == 'Trinh thám') ? 'selected' : ''; ?>>Trinh thám</option>
                    <option value="Truyện tranh" <?php echo ($sach['the_loai'] == 'Truyện tranh') ? 'selected' : ''; ?>>Truyện tranh</option>
                    <option value="Sách giáo khoa" <?php echo ($sach['the_loai'] == 'Sách giáo khoa') ? 'selected' : ''; ?>>Sách giáo khoa</option>

                </select>
            </div>
            
            <div>
                <input type="number" name="so-luong" value="<?php echo $sach['so_luong'] ?>">
            </div>
            
            <div>
                <input type="number" name="gia-thue" value="<?php echo $sach['gia_thue'] ?>">
            </div>
            
            <div>
                <input type="number" name="gia-ban" value="<?php echo $sach['gia_ban'] ?>">
            </div>
            
            <div>
                <input type="number" name="nam-xuat-ban" value="<?php echo $sach['nam_xuat_ban'] ?>">
            </div>
            
            <div>
                <?php if(!empty($sach['anh_bia'])) { ?>
                    <p>Ảnh hiện tại:</p>
                    <img src="<?php echo $sach['anh_bia']; ?>" width="100" style="margin: 5px 0;">
                <?php } ?>
                <input type="file" name="fileToUpload" placeholder="Ảnh bìa sách mới">
                <small>Để trống nếu không đổi ảnh</small>
            </div>
            
            <div>
                <select name="quoc-gia">
                    <?php
                    $sql_qg = "SELECT * FROM quoc_gia";
                    $result_qg = mysqli_query($conn, $sql_qg);
                    while ($qg = mysqli_fetch_assoc($result_qg)) {
                        $selected = ($sach['quoc_gia_id'] == $qg['id']) ? 'selected' : '';
                        echo "<option value='{$qg['id']}' $selected>{$qg['ten_quoc_gia']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div>
                <textarea name="mo-ta"><?php echo $sach['mo_ta'] ?></textarea>
            </div>
            
            <div>
                <input type="submit" value="Cập nhật">
            </div>
        </form>
    </div>
    
    <?php
    if (!empty($_POST["ten-sach"]) &&
        !empty($_POST["the-loai"]) &&
        !empty($_POST["so-luong"]) &&
        !empty($_POST["gia-thue"]) &&
        !empty($_POST["gia-ban"]) &&
        !empty($_POST["nam-xuat-ban"]) &&
        !empty($_POST["quoc-gia"]) &&
        !empty($_POST["mo-ta"])
    ) {
        $tenSach = $_POST["ten-sach"];
        $theLoai = $_POST["the-loai"];
        $soLuong = $_POST["so-luong"];
        $giaThue = $_POST["gia-thue"];
        $giaBan = $_POST["gia-ban"];
        $namXB = $_POST["nam-xuat-ban"];
        $quocGia = $_POST["quoc-gia"];
        $moTa = $_POST["mo-ta"];
        
        // Xử lý ảnh nếu có upload mới
        $anhBia = $sach['anh_bia']; // Giữ ảnh cũ
        
        if(isset($_FILES["fileToUpload"]["name"]) && $_FILES["fileToUpload"]["name"] != "") {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File không phải là ảnh.";
                $uploadOk = 0;
            }
            
            if (file_exists($target_file)) {
                echo "File này đã tồn tại trên hệ thống";
                $uploadOk = 2;
            }
            
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "File quá lớn";
                $uploadOk = 0;
            }
            
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Chỉ những file JPG, JPEG, PNG & GIF mới được chấp nhận.";
                $uploadOk = 0;
            }
            
            if($uploadOk != 0) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $anhBia = $target_file; // Cập nhật ảnh mới
                }
            }
        }
        
        $sql = "UPDATE sach SET 
                ten_sach='$tenSach',
                the_loai='$theLoai',
                so_luong='$soLuong',
                gia_thue='$giaThue',
                gia_ban='$giaBan',
                nam_xuat_ban='$namXB',
                quoc_gia_id='$quocGia',
                mo_ta='$moTa',
                anh_bia='$anhBia'
                WHERE id_sach='$id'";
        
        mysqli_query($conn, $sql);
        header('location: index.php?page_layout=quanlysach');
        ob_end_flush();
    }
    ?>
</body>
</html>