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

    $str = "select * from D_patience";
    $obj = mysqli_query($connect, $str);
    $id = 1;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- FontAwesome -->
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
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #e9ecef !important;
        }
        .container {
            margin-top: 30px;
        }
        .profile-img {
            max-width: 150px;
            border-radius: 50%;
            margin: 20px auto;
            display: block;
        }
        h1, h2 {
            color: #007bff; /* สีฟ้าสำหรับธีมหมอ */
            text-align: center;
        }
        h1 {
            margin-top: 10px;
            font-size: 28px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .btn {
            font-size: 14px;
        }
        .text-primary {
            font-size: 14px;
            margin-left: 5px;
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
        <img src="<?php echo $image_account; ?>" class="profile-img" alt="Profile Image">
        <h1>ยินดีต้อนรับคุณ <?php echo $result_show['username_account']; ?></h1>
        <h2>ในฐานะ <?php echo $result_show['role_account']; ?></h2>

        <table class="table table-bordered table-hover mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>อีเมล</th>
                    <th>ความเสี่ยง</th>
                    <th>กรณีศึกษา</th>
                    <th>รักษา</th>
                    <th>สิ้นสุดการรักษา</th>
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
                            <a href="doc_treat.php?edit=<?= $result['username']; ?>" class="btn btn-success btn-sm">
                                <i class="fa fa-book" aria-hidden="true"></i> รักษา
                            </a>
                            <?php
                            if (!empty($result['docname'])) {
                                echo "<span class='text-primary'>(รักษาแล้ว)</span>";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#" onclick="confirmDelete('<?php echo $result['username']; ?>')" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash" aria-hidden="true"></i> สิ้นสุด
                            </a>
                        </td>
                    </tr>
                <?php
                    $id++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(username) {
            if (confirm("ยืนยันว่าต้องการสิ้นสุดการรักษาหรือไม่?")) {
                window.location.href = "delete_patient.php?username=" + username;
            }
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