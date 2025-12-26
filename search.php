<?php
include("connect.php");

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($q === '') exit;

$stmt = $conn->prepare("SELECT id_sach, ten_sach FROM sach WHERE LOWER(ten_sach) LIKE LOWER(?) LIMIT 10");
$like = "%".$q."%";
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Không tìm thấy sách nào.</p>";
} else {
    while ($row = $result->fetch_assoc()) {
        echo "<a href='index.php?page_layout=chitietsach&id_sach=".$row['id_sach']."'>".htmlspecialchars($row['ten_sach'])."</a>";
    }
}
?>
