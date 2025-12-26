<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thư viện</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("location: login.php");
    }
    
    // Kiểm tra vai trò
    $isAdmin = ($_SESSION["vai_tro_id"] == 1 || $_SESSION["vai_tro_id"] == 2);

    ?>
    
        <div class="cong-cu">
        <a href="index.php?page_layout=trangchu">Trang chủ</a>

        <div class="menu-an">
        <button class="menu-an-btn" onclick="theloai()">Thể loại ▼</button>
            <div id="menuan" class="dropdown-content">
                <a href="index.php?page_layout=theloai&the_loai=Tiểu thuyết">Tiểu Thuyết</a>
                <a href="index.php?page_layout=theloai&the_loai=Thiếu nhi">Thiếu nhi</a>
                <a href="index.php?page_layout=theloai&the_loai=Tâm lý">Tâm lý</a>
                <a href="index.php?page_layout=theloai&the_loai=Phiêu lưu">Phiêu lưu</a>
                <a href="index.php?page_layout=theloai&the_loai=Hồi ký - Tùy bút">Hồi ký - Tùy bút</a>
                <a href="index.php?page_layout=theloai&the_loai=Triết học">Triết học</a>
                <a href="index.php?page_layout=theloai&the_loai=Trinh thám">Trinh thám</a>
                <a href="index.php?page_layout=theloai&the_loai=Truyện tranh">Truyện tranh</a>
                <a href="index.php?page_layout=theloai&the_loai=Thư viện pháp luật">Thư viện pháp luật</a>
                <a href="index.php?page_layout=theloai&the_loai=Lịch sử - chính trị">Lịch sử - chính trị</a>
                <a href="index.php?page_layout=theloai&the_loai=Sách giáo khoa">Sách giáo khoa</a>
                <a href="index.php?page_layout=theloai&the_loai=Kinh tế - quản lý">Kinh tế - quản lý</a>
            </div>
        </div>
        <div class="admin">
            <?php if($isAdmin) { ?>
                <a href="index.php?page_layout=thuesach">Thuê sách</a>
                <a href="index.php?page_layout=quanlymuasach">Quản lý mua sách</a>
                <a href="index.php?page_layout=quanlysach">Quản lý sách</a>
                <a href="index.php?page_layout=nguoidung">Quản lý user</a>
            <?php } ?>
        </div>
    
        <div class="search-box">
            <input type="text" id="tim-kiem" placeholder="Tìm kiếm...">
            <div id="tim-kiem-kq" class="search-results"></div>
        </div>
        <div>
            <?php echo "Xin chào " . $_SESSION["username"]; ?>            
            <a href="index.php?page_layout=dangxuat">Đăng xuất</a>
        </div>
  </div>
    
    <main>
        <?php
        if (isset($_GET['page_layout'])) {
            switch ($_GET['page_layout']) {
                case 'trangchu':
                    include "trangchu.php";
                    break;
                case 'themsach':
                    include 'themsach.php';
                    break;
                case 'capnhatsach':
                    include 'capnhatsach.php';
                    break;
                case 'thuesach':
                    include "thuesach.php";
                    break;
                case 'themthue':
                    include 'themthue.php';
                    break;
                case 'quanlysach':
                    include 'quanlysach.php';
                    break;
                case 'quanlymuasach':
                    include 'quanlymuasach.php';
                    break;
                case 'nguoidung':
                    include "nguoidung.php";
                    break;
                case 'themnguoidung':
                    include 'themnguoidung.php';
                    break;
                case 'capnhatnguoidung':
                    include 'capnhatnguoidung.php';
                    break;
                case 'chitietsach':
                    include 'chitietsach.php';
                    break;
                case 'muonsach':
                    include 'muonsach.php';
                    break;
                case 'muasach':
                    include 'muasach.php';
                    break;
                case 'theloai':
                    include 'theloai.php';
                    break;
                case 'search':
                    include 'search.php';
                    break;
                case 'dangxuat':
                    session_unset();
                    session_destroy();
                    header('location: login.php');
                    break;
            }
        } else {
            include 'trangchu.php';
        }
        ?>
    </main>

    <script src="script1.js"></script>
  <script src="script2.js"></script>
  <script src="script3.js"></script>
</body>
</html>