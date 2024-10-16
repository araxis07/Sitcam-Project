<?php
session_start();
$open_connect = 1;
require('connect.php');

if (isset($_GET['username']) && $_SESSION['role_account'] == 'admin') {
    $delete_username = $_GET['username'];
    $query_report = "UPDATE account SET reported_count = 1 WHERE username_account = '$delete_username'";
    
    if (mysqli_query($connect, $query_report)) {
        $delete_query = "DELETE FROM D_patience WHERE username = '$delete_username'"; 
        if(mysqli_query($connect, $delete_query)){
            header('Location: admin.php'); 
        }
        
        
        
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    print($delete_query);
    exit;
}
?>
