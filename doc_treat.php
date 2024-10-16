<?php
session_start();
$open_connect = 1;
require('connect.php');

if (!isset($_SESSION['id_account']) || $_SESSION['role_account'] != 'admin') { //ถ้าไม่มีเซสชัน id_account หรือเซสชัน role_account จะถูกส่งไปหน้า login
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
    $directory = 'images_account/';
    $image_name = $directory . $result_show['images_account'];
    $clear_cache = '?' . filemtime($image_name);
    $image_account = $image_name . $clear_cache;


    
    $edit1 = $_GET['edit'];
    $_SESSION['edit2'] = $edit1;
    $str = "select * from D_patience where username = '$edit1'";
    $obj = mysqli_query($connect, $str);
    $result = mysqli_fetch_array($obj);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>การรักษา</title>
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
        .navbar {
            background-color: #007bff; /* สีน้ำเงินสำหรับธีมหมอ */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff !important;
        }
        .container {
            margin-top: 30px;
        }
        .form-group label {
            font-weight: bold;
        }
        h1 {
            color: #007bff;
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            width: 100%;
            margin-top: 20px;
        }
        .btn-danger {
            width: 100%;
            margin-top: 10px;
        }
        .treatment-options input[type="radio"] {
            margin-right: 10px;
        }
        .treatment-options label {
            display: block;
            margin-bottom: 5px;
        }
        .back-btn {
            margin-top: 20px;
            text-align: center;
        }
        .back-btn a {
            color: #007bff;
            text-decoration: none;
        }
        .back-btn a:hover {
            text-decoration: underline;
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
                <!-- คุณสามารถเพิ่มรายการเมนูเพิ่มเติมที่นี่ -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?logout=1"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- ข้อมูลผู้ป่วย -->
        <h1><i class="fas fa-notes-medical"></i> ข้อมูลผู้ป่วย</h1>
        <form>
            <div class="form-group">
                <label for="fname">ชื่อผู้ใช้ :</label>
                <input type="text" class="form-control" name="fname" value="<?= $result['username']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="lname">อีเมล :</label>
                <input type="text" class="form-control" name="lname" value="<?= $result['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">ความเสี่ยง :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['total_score']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">กรณีศึกษา :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['comments']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">การรักษา :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['treat_score']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">ข้อความ/การนัดหมาย :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['treat_comments']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">ชื่อแพทย์ :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['docname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">การติดต่อแพทย์ :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['doccon']; ?>" readonly>
            </div>
        </form>

        <!-- ฟอร์มการรักษา -->
        <h1 style="color: green;">การรักษา</h1>
        <form action="doc_treat_p.php" method="POST">
            <div class="form-group">
                <label><strong>เลือกวิธีการรักษา:</strong></label>
                <div class="treatment-options">
                    <label><input type="radio" name="t1" value="1"> ประคองอาการ</label>
                    <label><input type="radio" name="t1" value="2"> มาพบแพทย์ที่โรงพยาบาล</label>
                    <label><input type="radio" name="t1" value="3"> สามารถเข้าคลินิกได้</label>
                    <label><input type="radio" name="t1" value="4"> สวดอภิธรรม</label>
                    <label><input type="radio" name="t1" value="5"> รักษาใจก่อน</label>
                    <label><input type="radio" name="t1" value="6"> ทำบุญเยอะๆ</label>
                    <label><input type="radio" name="t1" value="7"> เผา!!!</label>
                </div>
            </div>
            <div class="form-group">
                <label>อื่นๆ :</label>
                <textarea class="form-control" name="treat_comments" required placeholder="ข้อความเพิ่มเติม..."></textarea>
            </div>
            <div class="form-group">
                <label>ชื่อแพทย์ :</label>
                <input type="text" class="form-control" name="doc_name" placeholder="ระบุชื่อแพทย์">
            </div>
            <div class="form-group">
                <label>การติดต่อ :</label>
                <input type="text" class="form-control" name="doc_con" placeholder="ระบุวิธีการติดต่อ">
            </div>
            <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> ส่งข้อมูล</button>
            <button type="reset" name="reset" class="btn btn-danger" onclick="goBack()"><i class="fas fa-undo"></i> ยกเลิก</button>
        </form>

        <div class="back-btn">
            <a href="#" onclick="goBack()"><i class="fas fa-arrow-left"></i> กลับไปหน้าก่อนหน้า</a>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <!-- เชื่อมต่อกับ jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>