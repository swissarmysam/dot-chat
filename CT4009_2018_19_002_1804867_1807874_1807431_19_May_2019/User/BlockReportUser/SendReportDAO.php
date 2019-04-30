<?php

// This script adds a report about the user to the report table. 
// The data is populated from BlockReportUser.js

require_once(__DIR__ . "/../../inc/lib/php/config.inc.php");

require_once(__DIR__ . "/../../inc/lib/php/mysqli_connect.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $connection = openConnection();

    $type = $_POST['type'];
    $user_id = $_POST['uid'];

    $timestamp = date('Y-m-d H:i:s');
    $set_date = strtotime($timestamp);
    $datetime = date("Y-m-d H:i:s", $set_date);
    
    $sql = "INSERT INTO `tbl_reports` (`user_id`, `report_reason`, `date_time_reported`) VALUES ('$user_id', '$type', '$datetime')";

    mysqli_query($connection, $sql);

    if (mysqli_affected_rows($connection) == 1) {

        echo "success";
        closeConnection($connection);
        exit;

    } else {

        echo "fail";
        closeConnection($connection);
        exit;

    }

}

?>