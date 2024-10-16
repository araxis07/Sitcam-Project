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
    <title>ผลการวินิจฉัย</title>
    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- เชื่อมต่อกับ Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- เชื่อมต่อกับ FontAwesome สำหรับไอคอน -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <style>
        body {
            background-color: #f0f8ff; /* พื้นหลังสีฟ้าอ่อนสำหรับธีมหมอ */
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
            max-width: 800px;
        }
        h1 {
            color: #007bff; /* สีฟ้าสำหรับธีมหมอ */
            margin-bottom: 30px;
        }
        .diagnosis-fieldset {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .doctor-info {
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
        .note {
            margin-top: 40px;
            font-size: 16px;
            color: #555;
            text-align: center;
        }
        .logout-btn {
            margin-top: 20px;
            text-align: center;
        }
        .logout-btn a {
            color: #fff;
            text-decoration: none;
        }
        .logout-btn a:hover {
            text-decoration: none;
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
                <!-- คุณสามารถเพิ่มรายการเมนูเพิ่มเติมที่นี่ -->
               
            </ul>
        </div>
    </nav>

    <!-- เนื้อหาหลัก -->
    <div class="container">
        <h1 class="text-center">ผลการวินิจฉัย : <?php echo $result['total_score']; ?></h1>

        <div class="diagnosis-fieldset">
            <h3>
                ตามอาการที่คนไข้ประสบพบเจอ: <?php echo $result['comments']; ?><br><br>
                คนไข้สามารถ: <?php echo $result['treat_score']; ?><br><br>
                และขอแนะนำให้ปฏิบัติ/มาตามนัด ดังนี้:<br> <?php echo $result['treat_comments']; ?>
            </h3>

            <div class="doctor-info">
                <strong>คุณหมอ <?php echo $result['docname']; ?></strong><br>
                ติดต่อหมอ: <?php echo $result['doccon']; ?>
            </div>
        </div>

        <div class="note">
            <p>"เมื่อเสร็จสิ้นการรักษา" หน้านี้จะถูกลบไปโดยอัตโนมัติ<br>กรุณาติดตามผลกับแพทย์</p>
        </div>

        <div class="logout-btn">
            <a href="index.php?logout=1" class="btn btn-danger btn-lg">
                <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
            </a>
        </div>
    </div>

    <!-- เชื่อมต่อกับ jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap 4 uses Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- เชื่อมต่อกับ Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
