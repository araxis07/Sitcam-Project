<?php
session_start();
$open_connect = 1;
require('connect.php');

$username_account = $_SESSION['username_account'];
$email_account = $_SESSION['email_account'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าคะแนนจากฟอร์ม
    $q1_score = isset($_POST['q1']) ? intval($_POST['q1']) : 0;
    $q2_score = isset($_POST['q2']) ? intval($_POST['q2']) : 0;
    $q3_score = isset($_POST['q3']) ? intval($_POST['q3']) : 0;
    $q4_score = isset($_POST['q4']) ? intval($_POST['q4']) : 0;
    $q5_score = isset($_POST['q5']) ? intval($_POST['q5']) : 0;
    $q6_score = isset($_POST['q6']) ? intval($_POST['q6']) : 0;
    $q7_score = isset($_POST['q7']) ? intval($_POST['q7']) : 0;

    // รวมคะแนนทั้งหมด
    $total_score = $q1_score + $q2_score + $q3_score + $q4_score + $q5_score + $q6_score + $q7_score;
    if($total_score <=7){
        $total_score = 'ความเสี่ยงต่ำ';
    }elseif($total_score > 7 && $total_score <=14) {
        $total_score = 'ความเสี่ยงกลาง';
    }elseif($total_score > 14 && $total_score <=21){
        $total_score = 'ตวามเสี่ยงสูง';
    }

    // รับค่าข้อความเพิ่มเติม
    $additional_comments = isset($_POST['additional_comments']) ? htmlspecialchars($_POST['additional_comments']) : '';

    $str = "insert into D_patience (username,total_score,comments,email) 
        values('$username_account','$total_score','$additional_comments','$email_account')";
    $obj = mysqli_query($connect,$str);
    
    if($obj){
        die(header('Location: Detail_finish.php'));
        
    }else{
        print($str);
        exit();
       
    }
}
?>