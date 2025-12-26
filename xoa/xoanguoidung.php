<?php
include("connect.php");
session_start();

// Chỉ admin mới được xóa
if($_SESSION["vai_tro_id"] != 1 && $_SESSION["vai_tro_id"] != 2) {
    echo "<script>alert('Bạn không có quyền truy cập!'); window.location.href='index.php';</script>";
    exit();
}

$id = $_GET["id"];
$sql = "DELETE FROM nguoi_dung WHERE id_user = '$id'";
$result = mysqli_query($conn, $sql);

header("location: index.php?page_layout=nguoidung");
?>