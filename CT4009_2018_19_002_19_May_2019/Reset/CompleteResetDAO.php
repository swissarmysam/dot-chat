<?php

/* *************************************************************************************** */
/* * CompleteResetDAO.php handles the password reset after it is submitted               * */
/* * It will also set the link used to reset the password to expire so it can't be       * */
/* * used more than once. It will then redirect and set a query string for the next page * */
/* *************************************************************************************** */

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php'); // include db connection script

session_start(); // start session so session variables can be accessed

$connection = openConnection();
 
$user_id = $_SESSION['user_id_reset_pw']; // get user id from the session created by VerifyResetDAO.php
$password =  mysqli_real_escape_string($connection, (password_hash($_POST['password'], PASSWORD_DEFAULT)));  // hash password and sanitise
 
$sql = "UPDATE `tbl_members` 
        SET `password`='$password'
        WHERE `user_id`=$user_id";
 
$query = mysqli_query($connection, $sql) or die(mysqli_error($connection)); // update the password
 
if(mysqli_affected_rows($connection) == 1) { // if the password reset worked then ...
    // set the record used for reset as expired
    $expire = mysqli_query($connection, "UPDATE `tbl_password_reset_request` SET `expired`=1 WHERE `user_id`=$user_id") or die(mysqli_error($connection));
    header("Location: ../index.php?pwReset=success"); // redirect with successful message
    exit;

} else { // return with a failed url

    header("Location: ./ResetStatus.php?resetResult=fail");
    exit;

}

?>