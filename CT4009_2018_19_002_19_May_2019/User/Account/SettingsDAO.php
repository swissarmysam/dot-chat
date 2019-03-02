<?php

include_once('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    session_start();

    $id = $_SESSION['user_id']; // get user id to handle request
    $aid = $_POST['aid']; // action id to invoke correct process 

    $connection = openConnection(); // connect to database

    if($aid == "deactivate") {
        
        $result = mysqli_query($connection, "UPDATE `tbl_members` SET `acc_active`=0 WHERE `user_id`=$id");
        

         if(mysqli_affected_rows($connection) > 0) { // check if row matches query ...

            echo "success"; // respond to request with "success" to handle next step in JS file
            closeConnection($connection); // close the database connection
            exit(); // kill the script process

         } else {
            trigger_error("Query: $result\nMySQL Error: " . mysqli_error($connection));
            closeConnection($connection);
            echo "fail";
            exit();

         }
     
    }
}

    
?>