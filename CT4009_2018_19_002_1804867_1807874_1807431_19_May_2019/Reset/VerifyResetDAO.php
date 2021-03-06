<?php

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php');

session_start();

$connection = openConnection();
 
// get data from reset link
$user_id = isset($_GET['uid']) ? trim($_GET['uid']) : '';
$token = isset($_GET['request']) ? trim($_GET['request']) : '';
$request_id = isset($_GET['id']) ? trim($_GET['id']) : '';
 
 
// Query the password_reset_request table and
// ensure the details belong to a valid reset request 
// and which is not already expired
 
$sql = "SELECT `request_id`, `user_id`, `date_time_requested` 
        FROM `tbl_password_reset_request` 
        WHERE `request_id`=$request_id AND `user_id`=$user_id AND `token`='$token' AND `expired`=0";
 
$query = mysqli_query($connection, $sql) or die(mysqli_error($connection));
 
if(@mysqli_num_rows($query) == 1) {
 
    //The request is valid so assign a session variable
    //that gives them access to the reset password form.
    $_SESSION['user_id_reset_pw'] = $user_id;
    
    //Redirect to the password reset
    header('Location: CompleteReset.php');
    exit;
} else {
    // Redirect to status page to display error message
    header('Location: ./ResetStatus.php?resetResult=fail');
    exit;
}

?>