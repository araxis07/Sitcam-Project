<?php
session_start();
$open_connect = 1;
require('connect.php');

if (!isset($_SESSION['id_account']) || !isset($_SESSION['role_account'])) { //ถ้าไม่มีเซสชัน id_account หรือเซสชัน role_account จะถูกส่งไปหน้า login
    die(header('Location: form-login.php'));
} elseif (isset($_GET['logout'])) { //ถ้ามีการกดปุ่มออกจากระบบให้ทำการทำลายเซสชันและส่งไปหน้า login
    session_destroy();
    die(header('Location: form-login.php'));
} else {
    $id_account = $_SESSION['id_account'];
    $username_account = $_SESSION['username_account'];
    $query_show = "SELECT * FROM account WHERE id_account = '$id_account'";
    $call_back_show = mysqli_query($connect, $query_show);
    $result_show = mysqli_fetch_assoc($call_back_show);

    $str = "select * from D_patience where username = '$username_account'";
    $obj = mysqli_query($connect, $str);
    $result = mysqli_fetch_array($obj);

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>รอการตอบกลับจากคุณหมอ</title>
    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <style>
        body {
            background-color: #f0f8ff; /* พื้นหลังสีฟ้าอ่อน */
        }
        .container {
            margin-top: 50px;
        }
        .navbar {
            background-color: #007bff; /* สีน้ำเงินสำหรับธีมหมอ */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #e9ecef !important;
        }
        .btn-lg {
            font-size: 1.25rem;
            padding: .75rem 1.25rem;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        .lead {
            font-size: 1.25rem;
            font-weight: 300;
        }
    </style>
</head>

<body>

    <!-- แถบนำทาง -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#"><i class="fas fa-user-md"></i> ระบบแพทย์</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="สลับการนำทาง">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- ลิงก์นำทางเพิ่มเติม -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">

            </ul>
        </div>
    </nav>

    <div class="container text-center">
        <h1 class="mt-5 mb-4">รอการตอบกลับจากคุณหมอ</h1>
        <p class="lead">ขณะนี้รอคุณหมอตอบกลับนะครับ สามารถกดออกจากระบบก่อนได้ และคอยเช็คดูว่าคุณหมอตอบกลับเมื่อไหร่</p>

        <div class="mt-5">
            <form method="POST" action="check_bt.php" class="d-inline">
                <?php if ($result['p_show_count'] == 1) { ?>
                    <button type="submit" class="btn btn-success btn-lg" name="btn">
                        <i class="fas fa-arrow-right"></i> ดำเนินการต่อ
                    </button>
                <?php } elseif ($result['p_show_count'] >= 2) { ?>
                    <button type="submit" class="btn btn-warning btn-lg" name="btn">
                        <i class="fas fa-exclamation-circle"></i> ดำเนินการต่อ (มีอัพเดท)
                    </button>
                <?php } ?>
            </form>

            <a href="index.php?logout=1" class="btn btn-danger btn-lg ml-2">
                <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
            </a>
        </div>
    </div>

    <!-- jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
