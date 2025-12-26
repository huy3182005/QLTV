<?php
session_start();

// Xóa tất cả session
session_unset();
session_destroy();

// Chuyển về trang login
header('Location: login.php');
exit();
?>