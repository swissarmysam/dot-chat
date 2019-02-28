<?php

include_once('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php');

/* Function to save images to tbl_posts - saves image to an uploads directory and stores pointer in table */
/* Will not work with GIFs */
/* Needs validation to make sure that it is an image being uploaded and perhaps a file size limit */

if($_SERVER['REQUEST_METHOD'] == 'POST') { // only save record if submit method is POST

    session_start();

    $connection = openConnection(); // open database connection set in mysqli_connect.php

    // Set variable values from dataString in Register.js and use use real_escape_string to prevent SQL injection with special characters
    $to = $_SESSION['other_id'];
    $from = $_SESSION['user_id'];
    $origin = $_SESSION['country_name'];

    $timestamp = date('Y-m-d H:i:s');
    $set_date = strtotime($timestamp);
    $date = date("Y-m-d H:i:s", $set_date);
    
    $image = $_FILES['image']['name'];

    $target = "uploads/" . basename($image);

    // build SQL query to save post data in tbl_posts in database - by not quoting the variables where they could be empty they are interpreted as NULL not "NULL"
    $query = "INSERT INTO `tbl_posts` (`user_id`, `wall_id`, `post_img`, `post_origin`, `date_time_posted`) VALUES ('$from', '$to', '$image', '$origin', '$date')";

    mysqli_query($connection, $query); 
 
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        header("Location: ./WallPosts.php");
        exit;
    } else {
        echo "This filetype is not supported. Try uploading a PNG/JPEG.";
        trigger_error("Query: $query\nMySQL Error: " . mysqli_error($connection)); // error to be handled by error handler defined in config.inc.php
    }

    closeConnection($connection); // close database connection after action is complete - defined in mysqli_connect.php
}

?>