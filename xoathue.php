<?php
include("connect.php");
session_start();

$id = $_GET["id"];

// Kiểm tra quyền: Admin hoặc người thuê mới được xóa
$isAdmin = ($_SESSION["vai_tro_id"] == 1 || $_SESSION["vai_tro_id"] == 2);

if(!$isAdmin) {
    // Lấy id user hiện tại
    $username = $_SESSION["username"];
    $sql_check = "SELECT ts.*, nd.ten_dang_nhap 
                  FROM thue_sach ts 
                  JOIN nguoi_dung nd ON ts.id_user = nd.id_user 
                  WHERE ts.id_muon = '$id'";
    $result_check = mysqli_query($conn, $sql_check);
    $thue_check = mysqli_fetch_assoc($result_check);
    
    // Nếu không phải người thuê thì không cho xóa
    if($thue_check['ten_dang_nhap'] != $username) {
        echo "<script>alert('Bạn không có quyền xóa thuê sách này!'); window.location.href='index.php?page_layout=thuesach';</script>";
        exit();
    }
}

$sql = "DELETE FROM thue_sach WHERE id_muon = '$id'";
$result = mysqli_query($conn, $sql);

header("location: index.php?page_layout=thuesach");
?>