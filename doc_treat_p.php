<?php
session_start();
$open_connect = 1;
require('connect.php');
$username_account = $_SESSION['username_account'];
$email_account = $_SESSION['email_account'];
$edit_name = $_SESSION['edit2'];

$p_show_count = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าคะแนนจากฟอร์ม
    $t1_score = isset($_POST['t1']) ? intval($_POST['t1']) : 0;


    // รวมคะแนนทั้งหมด
    $treat_score = $t1_score;
    if ($treat_score == 1) {
        $treat_score = 'ประคองอาการ';
    } elseif ($treat_score == 2) {
        $treat_score = 'มาพบแพทย์ที่รพ.';
    } elseif ($treat_score == 3) {
        $treat_score = 'สามารถเข้าคลินิคได้';
    } elseif ($treat_score == 4) {
        $treat_score = 'สวดอภิธรรม';
    } elseif ($treat_score == 5) {
        $treat_score = 'รักษาใจก่อน';
    } elseif ($treat_score == 6) {
        $treat_score = 'ทำบุญเยอะๆ';
    } elseif ($treat_score == 7) {
        $treat_score = 'เผา!!!';
    }

    // รับค่าข้อความเพิ่มเติม
    $treat_comments = mysqli_real_escape_string($connect, $_POST['treat_comments']);
    $doc_name = mysqli_real_escape_string($connect, $_POST['doc_name']);
    $doc_con = mysqli_real_escape_string($connect, $_POST['doc_con']);

    $str = "UPDATE D_patience set treat_score = '$treat_score'
    ,treat_comments = '$treat_comments'
    ,docname = '$doc_name' 
    ,doccon = '$doc_con' 
    ,p_show_count = p_show_count + 1
    where username = '$edit_name'";
    $obj = mysqli_query($connect, $str);

    if (!$obj) {
        echo "Error updating record: " . mysqli_error($connect);
    }

    if ($obj) {
        echo "Done!!!";
        echo "<meta http-equiv='refresh' content='3;URL=admin.php' />";
    } else {
        print($obj);
        exit();
    }
}
