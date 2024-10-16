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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMBER</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        center {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        img {
            max-width: 150px;
            border-radius: 50%;
            margin-top: 20px;
        }
        h1, h2 {
            color: #333;
        }
        h1 {
            margin-top: 20px;
        }
        a {
            color: red;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form p {
            font-weight: bold;
            color: #333;
        }
        form input[type="radio"] {
            margin-right: 10px;
        }
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #4CAF50;
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
            background-color: #45a049;
        }
        .question {
            margin-bottom: 20px;
        }
        .question p {
            margin-bottom: 10px;
        }
    </style>
<body>
<center>
        <img src="<?php echo $image_account; ?>">
    <h1>ยินดีต้อนรับคุณ <?php echo $result_show['username_account']; ?> ในฐานะ <?php echo $result_show['role_account']; ?></h1>
    <h2><a href="index.php?logout=1">ออกจากระบบ</a></h2>

    <h2>แบบสอบถาม</h2>
    <form action="insert-p.php" method="POST">
        <!-- คำถามแบบ ratio จำนวน 7 ข้อ -->
        <p>1. ข้อ 1: คำถามนี้เป็นอย่างไร?</p>
        <input type="radio" name="q1" value="1"> ตัวเลือก 1 (1 คะแนน)<br>
        <input type="radio" name="q1" value="2"> ตัวเลือก 2 (2 คะแนน)<br>
        <input type="radio" name="q1" value="3"> ตัวเลือก 3 (3 คะแนน)<br>

        <p>2. ข้อ 2: คุณเห็นด้วยมากน้อยแค่ไหน?</p>
        <input type="radio" name="q2" value="1"> ไม่เห็นด้วยเลย (1 คะแนน)<br>
        <input type="radio" name="q2" value="2"> ค่อนข้างเห็นด้วย (2 คะแนน)<br>
        <input type="radio" name="q2" value="3"> เห็นด้วยมาก (3 คะแนน)<br>

        <p>3. ข้อ 3: คุณมีความคิดเห็นอย่างไร?</p>
        <input type="radio" name="q3" value="1"> ตัวเลือก A (1 คะแนน)<br>
        <input type="radio" name="q3" value="2"> ตัวเลือก B (2 คะแนน)<br>
        <input type="radio" name="q3" value="3"> ตัวเลือก C (3 คะแนน)<br>

        <p>4. ข้อ 4: คุณมีทัศนคติต่อเรื่องนี้อย่างไร?</p>
        <input type="radio" name="q4" value="1"> ตัวเลือก A (1 คะแนน)<br>
        <input type="radio" name="q4" value="2"> ตัวเลือก B (2 คะแนน)<br>
        <input type="radio" name="q4" value="3"> ตัวเลือก C (3 คะแนน)<br>

        <p>5. ข้อ 5: คุณเห็นด้วยกับข้อความนี้หรือไม่?</p>
        <input type="radio" name="q5" value="1"> ไม่เห็นด้วยเลย (1 คะแนน)<br>
        <input type="radio" name="q5" value="2"> เห็นด้วยเล็กน้อย (2 คะแนน)<br>
        <input type="radio" name="q5" value="3"> เห็นด้วยมาก (3 คะแนน)<br>

        <p>6. ข้อ 6: คุณคิดว่าแนวทางนี้เป็นอย่างไร?</p>
        <input type="radio" name="q6" value="1"> ไม่ดี (1 คะแนน)<br>
        <input type="radio" name="q6" value="2"> พอใช้ (2 คะแนน)<br>
        <input type="radio" name="q6" value="3"> ดีมาก (3 คะแนน)<br>

        <p>7. ข้อ 7: คุณมีความคิดเห็นเพิ่มเติมไหม?</p>
        <input type="radio" name="q7" value="1"> ไม่มี (1 คะแนน)<br>
        <input type="radio" name="q7" value="2"> มีเล็กน้อย (2 คะแนน)<br>
        <input type="radio" name="q7" value="3"> มีมาก (3 คะแนน)<br>

        <!-- Textarea สำหรับคำตอบเพิ่มเติม -->
        <p>ความคิดเห็นเพิ่มเติม:</p>
        <textarea name="additional_comments" rows="4" cols="50" placeholder="เขียนความคิดเห็นเพิ่มเติมที่นี่..."></textarea><br>

        <input type="submit" value="ส่งแบบสอบถาม">
    </form>
    </center>
</body>
</html>