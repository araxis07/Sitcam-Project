<?php
session_start();
$open_connect = 1;
require('connect.php');
$username_account = $_SESSION['username_account'];

if (isset($_POST['btn'])){
    $str = "UPDATE D_patience set p_show_count = 1
    where username = '$username_account'";
    $obj = mysqli_query($connect, $str);

    echo "<meta http-equiv='refresh' content='3;URL=total_receipt.php' />";
}
?>