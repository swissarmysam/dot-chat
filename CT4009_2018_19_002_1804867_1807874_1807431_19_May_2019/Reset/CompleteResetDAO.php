<?php

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php');

session_start(); // session is started to create a safe session for user to complete reset

$connection = openConnection(); // open db connection
 
$user_id = $_SESSION['user_id_reset_pw']; // get user id from current session
$password =  mysqli_real_escape_string($connection, (password_hash($_POST['password'], PASSWORD_DEFAULT))); // sanitize user password and use secure hash

// create query to update user password
$sql = "UPDATE `tbl_members` 
        SET `password`='$password'
        WHERE `user_id`=$user_id";

// run query against database
$query = mysqli_query($connection, $sql) or die(mysqli_error($connection));
 
if(mysqli_affected_rows($connection) == 1) { // if a row was successfully updated

    // expire the created token so that it cannot be reused
    $expire = mysqli_query($connection, "UPDATE `tbl_password_reset_request` SET `expired`=1 WHERE `user_id`=$user_id") or die(mysqli_error($connection)); 
    header("Location: ../index.php?pwReset=success"); // redirect user to login page with success query string
    exit;

} else {

    header("Location: ./ResetStatus.php?resetResult=fail"); // otherwise redirect to reset status page and include error query for page to handle
    exit;

}

?>