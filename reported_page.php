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

if(isset($_GET['reset_reported'])){
    $query_reported_default = "UPDATE account SET reported_count = 0 WHERE username_account = '$username_account'";
    $call_back_report_default = mysqli_query($connect, $query_reported_default);
    session_destroy();
    die(header('Location: form-login.php'));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ผลการรักษา</title>
    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS และ FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <style>
        body {
            background-color: #f0f8ff; /* พื้นหลังสีฟ้าอ่อนสำหรับธีมหมอ */
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 100px;
            text-align: center;
        }
        h1 {
            color: #007bff; /* สีฟ้าสำหรับธีมหมอ */
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #28a745; /* สีเขียวสำหรับความสำเร็จ */
            border-color: #28a745;
            font-size: 18px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .fa-heartbeat {
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <!-- แถบนำทาง -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #007bff;">
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

    <!-- เนื้อหาหลัก -->
    <div class="container">
        <h1><i class="fas fa-heartbeat"></i> เสร็จสิ้นการรักษาแล้ว ลงโลงได้</h1>
        <a href="reported_page.php?reset_reported=1">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check-circle"></i> สิ้นสุดการรักษา
            </button>
        </a>
    </div>

    <!-- เชื่อมต่อกับ jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>