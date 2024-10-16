<?php
session_start();
$open_connect = 1;
require('connect.php');

if(!isset($_SESSION['id_account']) || !isset($_SESSION['role_account'])){//ถ้าไม่มีเซสชัน id_account หรือเซสชัน role_account จะถูกส่งไปหน้า login
    die(header('Location: form-login.php'));
}elseif(isset($_GET['logout'])){ //ถ้ามีการกดปุ่มออกจากระบบให้ทำการทำลายเซสชันและส่งไปหน้า login
    session_destroy();
    die(header('Location: form-login.php'));
}else{
    $id_account = $_SESSION['id_account'];
    $username_account = $_SESSION['username_account'];
    $query_show = "SELECT * FROM account WHERE id_account = '$id_account'";
    $call_back_show = mysqli_query($connect, $query_show);
    $result_show = mysqli_fetch_assoc($call_back_show);
    $directory = 'images_account/';
    $image_name = $directory . $result_show['images_account'];
    $clear_cache = '?' . filemtime($image_name);
    $image_account = $image_name . $clear_cache;
}

$check_patience = "SELECT * FROM D_patience WHERE username = '$username_account'";
$call_back_patience_account = mysqli_query($connect, $check_patience);
if(mysqli_num_rows($call_back_patience_account) == 1){
    die(header('Location: Detail_finish.php'));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MEMBER</title>
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
            max-width: 800px;
            margin-top: 30px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .logout-btn {
            margin-top: 20px;
            text-align: center;
        }
        .logout-btn a {
            color: #dc3545; /* สีแดงสำหรับปุ่มออกจากระบบ */
            font-size: 18px;
            text-decoration: none;
        }
        .logout-btn a:hover {
            text-decoration: underline;
        }
        .question {
            margin-bottom: 20px;
        }
        .question p {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .options label {
            display: block;
            margin-bottom: 5px;
            font-weight: normal;
        }
        .options input[type="radio"] {
            margin-right: 10px;
        }
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #007bff; /* สีเขียวสำหรับปุ่มส่งแบบสอบถาม */
            color: white;
            padding: 14px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #003D7FFF;
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
        <img class="profile-img" src="<?php echo $image_account; ?>" alt="Profile Image">
        <h1><i class="fas fa-user-md"></i> ยินดีต้อนรับคุณ <?php echo $result_show['username_account']; ?></h1>
        <h2>ในฐานะ <?php echo $result_show['role_account']; ?></h2>

        <form action="insert-p.php" method="POST">
            <h2><i class="fas fa-notes-medical"></i> แบบสอบถาม</h2>
            <!-- คำถามแบบ ratio จำนวน 7 ข้อ -->
            <div class="question">
                <p>1. ข้อ 1: คำถามนี้เป็นอย่างไร?</p>
                <div class="options">
                    <label><input type="radio" name="q1" value="1"> ตัวเลือก 1 (1 คะแนน)</label>
                    <label><input type="radio" name="q1" value="2"> ตัวเลือก 2 (2 คะแนน)</label>
                    <label><input type="radio" name="q1" value="3"> ตัวเลือก 3 (3 คะแนน)</label>
                </div>
            </div>
            <div class="question">
                <p>2. ข้อ 2: คุณเห็นด้วยมากน้อยแค่ไหน?</p>
                <div class="options">
                    <label><input type="radio" name="q2" value="1"> ไม่เห็นด้วยเลย (1 คะแนน)</label>
                    <label><input type="radio" name="q2" value="2"> ค่อนข้างเห็นด้วย (2 คะแนน)</label>
                    <label><input type="radio" name="q2" value="3"> เห็นด้วยมาก (3 คะแนน)</label>
                </div>
            </div>
            <div class="question">
                <p>3. ข้อ 3: คุณมีความคิดเห็นอย่างไร?</p>
                <div class="options">
                    <label><input type="radio" name="q3" value="1"> ตัวเลือก A (1 คะแนน)</label>
                    <label><input type="radio" name="q3" value="2"> ตัวเลือก B (2 คะแนน)</label>
                    <label><input type="radio" name="q3" value="3"> ตัวเลือก C (3 คะแนน)</label>
                </div>
            </div>
            <div class="question">
                <p>4. ข้อ 4: คุณมีทัศนคติต่อเรื่องนี้อย่างไร?</p>
                <div class="options">
                    <label><input type="radio" name="q4" value="1"> ตัวเลือก A (1 คะแนน)</label>
                    <label><input type="radio" name="q4" value="2"> ตัวเลือก B (2 คะแนน)</label>
                    <label><input type="radio" name="q4" value="3"> ตัวเลือก C (3 คะแนน)</label>
                </div>
            </div>
            <div class="question">
                <p>5. ข้อ 5: คุณเห็นด้วยกับข้อความนี้หรือไม่?</p>
                <div class="options">
                    <label><input type="radio" name="q5" value="1"> ไม่เห็นด้วยเลย (1 คะแนน)</label>
                    <label><input type="radio" name="q5" value="2"> เห็นด้วยเล็กน้อย (2 คะแนน)</label>
                    <label><input type="radio" name="q5" value="3"> เห็นด้วยมาก (3 คะแนน)</label>
                </div>
            </div>
            <div class="question">
                <p>6. ข้อ 6: คุณคิดว่าแนวทางนี้เป็นอย่างไร?</p>
                <div class="options">
                    <label><input type="radio" name="q6" value="1"> ไม่ดี (1 คะแนน)</label>
                    <label><input type="radio" name="q6" value="2"> พอใช้ (2 คะแนน)</label>
                    <label><input type="radio" name="q6" value="3"> ดีมาก (3 คะแนน)</label>
                </div>
            </div>
            <div class="question">
                <p>7. ข้อ 7: คุณมีความคิดเห็นเพิ่มเติมไหม?</p>
                <div class="options">
                    <label><input type="radio" name="q7" value="1"> ไม่มี (1 คะแนน)</label>
                    <label><input type="radio" name="q7" value="2"> มีเล็กน้อย (2 คะแนน)</label>
                    <label><input type="radio" name="q7" value="3"> มีมาก (3 คะแนน)</label>
                </div>
            </div>
            <!-- Textarea สำหรับคำตอบเพิ่มเติม -->
            <div class="question">
                <p>ความคิดเห็นเพิ่มเติม:</p>
                <textarea name="additional_comments" rows="4" placeholder="เขียนความคิดเห็นเพิ่มเติมที่นี่..."></textarea>
            </div>
            <input type="submit" value="ส่งแบบสอบถาม">
        </form>
    </div>

    <!-- เชื่อมต่อกับ jQuery และ Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
