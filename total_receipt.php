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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>Document</title>
</head>

<body>
    <center>
        <h1>ผลวินินิจฉัย : <?php echo $result['total_score']; ?></h1><br>
        <fieldset style="text-align: left; width: 700px; height: auto;">
            <div>
                <h3>
                    ตามอาการที่คนไข้ประสบพบเจอ <?php echo $result['comments']; ?><br>
                    คนไข้สามารถ <?php echo $result['treat_score']; ?><br>
                    และขอแนะนำให้ปฏิบัติ/มาตามนัด ดังนี้ : <br> <?php echo $result['treat_comments']; ?>
                </h3>

            </div>
            <br>
            <br>
            <br>
            <div style="float: right;">
                คุณหมอ <?php echo $result['docname']; ?>
                <br>
                ติดต่อหมอ <?php echo $result['doccon']; ?>
            </div>
        </fieldset>
    </center>
    <br>
    <br>
    <br>
    <center>
        <h5>"เมื่อเสร็จสินการรักษา" หน้านี้จะถูกลบไปโดยอัตโนมัติ//กรุณาติดตามผลกับแพทย์</h5>
        <a href="index.php?logout=1">
            <button type="submit" class="btn btn-danger">ออกจากระบบ</button>
        </a>
    </center>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
