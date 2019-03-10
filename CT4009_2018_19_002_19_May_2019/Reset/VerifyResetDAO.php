<?php

/* *************************************************************************************** */
/* * VerifyResetDAO.php checks that the link information is actually in the table        * */
/* * It will then either redirect to complete the password reset or return a fail msg    * */
/* *************************************************************************************** */

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php'); // db connect script

session_start(); // create session for reset to be completed

$connection = openConnection();
 
// get variable values from URL created by RequestResetDAO.php 
// if values don't exist then set as ''
$user_id = isset($_GET['uid']) ? trim($_GET['uid']) : ''; 
$token = isset($_GET['request']) ? trim($_GET['request']) : '';
$request_id = isset($_GET['id']) ? trim($_GET['id']) : '';
 
// check that the GET variables are actually in the table and not expired 
$sql = "SELECT `request_id`, `user_id`, `date_time_requested` 
        FROM `tbl_password_reset_request` 
        WHERE `request_id`=$request_id AND `user_id`=$user_id AND `token`='$token' AND `expired`=0";
 
$query = mysqli_query($connection, $sql) or die(mysqli_error($connection));
 
if(@mysqli_num_rows($query) == 1) { // If a record is found then ...
 
    // the request is valid so create a session variable for the user
    $_SESSION['user_id_reset_pw'] = $user_id;
    
    //Redirect to the password reset form
    header('Location: CompleteReset.php');
    exit;
} else {
    // return with a fail query
    header('Location: ./ResetStatus.php?resetResult=fail');
    exit;
}

?>