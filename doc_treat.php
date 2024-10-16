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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form>
            <div class="form-group">
                <label for="fname">Username :</label>
                <input type="text" class="form-control" name="fname" value="<?= $result['username']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="lname">Email :</label>
                <input type="text" class="form-control" name="lname" value="<?= $result['email']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Risk :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['total_score']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Case :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['comments']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Treat :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['treat_score']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Text/Appointment :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['treat_comments']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Doctor name :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['docname']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Doctor contact :</label>
                <input type="text" class="form-control" name="email" value="<?= $result['doccon']; ?>" readonly>
            </div>
        </form>
    </div>

    <br><br><br>
    <h1 style="color: green;">Treatment</h1>
    <div class="container">
        <form action="doc_treat_p.php" method="POST">
            <div class="form-group">
                <input type="radio" name="t1" value="1"> ประคองอาการ<br>
                <input type="radio" name="t1" value="2"> มาพบแพทย์ที่รพ.<br>
                <input type="radio" name="t1" value="3"> สามารถเข้าคลินิคได้<br>
                <input type="radio" name="t1" value="4"> สวดอภิธรรม<br>
                <input type="radio" name="t1" value="5"> รักษาใจก่อน<br>
                <input type="radio" name="t1" value="6"> ทำบุญเยอะๆ<br>
                <input type="radio" name="t1" value="7"> เผา!!!<br>
            <div class="form-group">
                <label >etc. :</label>
                <textarea class="form-control" name="treat_comments" required="">Message</textarea>
            <div class="form-group">
                <label >Doctor :</label>
                <input type="text" class="form-control" name="doc_name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label >Contact :</label>
                <input type="text" class="form-control" name="doc_con" placeholder="Give Contact">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
            <input type="reset" name="reset" class="btn btn-danger" style="float:left;" value="Reset" onclick="goBack()">
        </form>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>