<?php

include('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php');

session_start();

$connection = openConnection();
 

$user_id = isset($_GET['uid']) ? trim($_GET['uid']) : '';
$token = isset($_GET['request']) ? trim($_GET['request']) : '';
$request_id = isset($_GET['id']) ? trim($_GET['id']) : '';
 
$sql = "SELECT `request_id`, `user_id`, `date_time_requested` 
        FROM `tbl_password_reset_request` 
        WHERE `request_id`=$request_id AND `user_id`=$user_id AND `token`='$token' AND `expired`=0";
 
$query = mysqli_query($connection, $sql) or die(mysqli_error($connection));
 
if(@mysqli_num_rows($query) == 1) {
 
    // If a matching record was found in the table, then create a session for the user.
    $_SESSION['user_id_reset_pw'] = $user_id;
    
    // Redirect the user to the complete the password reset
    header('Location: CompleteReset.php');
    exit;
} else {
    // Redirect user to the failed page for next step.
    header('Location: ResetFail.php');
    exit;
}

?>