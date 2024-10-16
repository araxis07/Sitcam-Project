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
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>Document</title>
</head>

<body>
    <h1>ขณะนี้รอคุณหมอตอบกลับนะครับ สามารถกดออกจากระบบก่อนได้ และคอยเช็คดูว่าคุณหมอตอบกลับเมื่อไหร่</h1>

    
    <form method="POST" action="check_bt.php"> 
            <?php if ($result['p_show_count'] == 1) { ?>
                <button type="submit" class="btn btn-success" name="btn">ดำเนินการต่อ</button>
            <?php } elseif ($result['p_show_count'] >= 2) { ?>
                <button type="submit" class="btn btn-danger" name="btn">ดำเนินการต่อ (มีอัพเดท)</button>
            <?php }?>
    </form>

    <a href="index.php?logout=1">
        <button type="submit" class="btn btn-danger">ออกจากระบบ</button>
    </a>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>