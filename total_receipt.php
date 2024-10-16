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
    <title>Document</title>
</head>

<body>
    <center>
        <h2>ผลวินินิจฉัย : <?php echo $result['total_score']; ?></h2><br>
        <fieldset style="text-align: left; width: 350px; height: auto;">
            <div>
                ตามอาการที่คนไข้ประสบพบเจอ <?php echo $result['comments']; ?><br>
                คนไข้สามารถ <?php echo $result['treat_score']; ?><br>
                และขอแนะนำให้ปฏิบัติ/มาตามนัด ดังนี้ : <?php echo $result['treat_comments']; ?>
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




</body>

</html>