<?php

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php');

session_start();

$connection = openConnection();
 
// set user_id from session variable
$user_id = $_SESSION['user_id_reset_pw'];
// hash user entered password to store in table
$password =  mysqli_real_escape_string($connection, (password_hash($_POST['password'], PASSWORD_DEFAULT))); 

// query table to update the members password
$sql = "UPDATE `tbl_members` 
        SET `password`='$password'
        WHERE `user_id`=$user_id";
 
$query = mysqli_query($connection, $sql) or die(mysqli_error($connection));
 
if(mysqli_affected_rows($connection) == 1) { // if query altered a record
    // expire the token and redirect user to success page
    $expire = mysqli_query($connection, "UPDATE `tbl_password_reset_request` SET `expired`=1 WHERE `user_id`=$user_id") or die(mysqli_error($connection));
    header("Location: ../index.php?pwReset=success");
    exit;

} else {
    // redirect user to fail message
    header("Location: ./ResetStatus.php?resetResult=fail");
    exit;

}

?>