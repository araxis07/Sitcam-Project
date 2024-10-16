<?php
session_start();
$open_connect = 1;
require('connect.php');
// Test Commit to git repository

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

    $str = "select * from D_patience";
    $obj = mysqli_query($connect, $str);
    $id = 1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>ADMIN</title>
</head>

<body>
    <center>
        <img src="<?php echo $image_account; ?>">
        <h1>ยินดีต้อนรับคุณ <?php echo $result_show['username_account']; ?> ในฐานะ <?php echo $result_show['role_account']; ?></h1>
        <h2><a href="index.php?logout=1">ออกจากระบบ</a></h2>
    </center>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Que.</th>
                <th>Username</th>
                <th>Email</th>
                <th>Risk</th>
                <th>Case</th>
                <th>Treat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($result = mysqli_fetch_array($obj)) {

            ?>
                <tr>
                    <td><?php echo "No. " . $id; ?></td>
                    <td><?php echo $result['username']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $result['total_score']; ?></td>
                    <td><?php echo $result['comments']; ?></td>
                    <td>
                        <a href="doc_treat.php?edit=<?= $result['username']; ?>" style="color:green">
                            <i class="fa fa-book" aria-hidden="true"></i></a>&nbsp
                        <?php
                        
                        if (!empty($result['docname'])) {
                            echo "<span style='color:blue;'>(Treated)</span>";
                        }
                        ?>
                    </td>
                </tr>

            <?php
                $id++;
            }
            ?>
        </tbody>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>