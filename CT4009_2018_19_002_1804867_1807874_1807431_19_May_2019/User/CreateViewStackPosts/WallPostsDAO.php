<?php

include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php');

/* Function to save data to tbl_posts */

if($_SERVER['REQUEST_METHOD'] == 'POST') { // only save record if submit method is POST

    $connection = openConnection(); // open database connection set in mysqli_connect.php

    // Set variable values from dataString in Register.js and use use real_escape_string to prevent SQL injection with special characters
    $to = mysqli_real_escape_string($connection, $_POST['to']); // pass db connection as parameter and get wall id where post is being made
    $from = mysqli_real_escape_string($connection, $_POST['from']);  // user id who posted to the wall
    $origin = mysqli_real_escape_string($connection, $_POST['origin']); // the location of the user who is making the post

    // check if the POST data was empty and set the variable to NULL in DB table to prevent SQL query warnings. This means that one query can be used to add all data to the table.
    $contents = (empty($_POST['contents']) ? "" : mysqli_real_escape_string($connection, htmlspecialchars($_POST['contents']))); // use htmlspecialchars to prevent Cross Site Scripting (XSS)
    $title = (empty($_POST['title']) ? "NULL" : mysqli_real_escape_string($connection, htmlspecialchars($_POST['title'])));

    $image = (empty($_POST['image']) ? "NULL" : $_POST['image']); // put NULL in table if no image is present otherwise it is handled by SaveImageDAO.php

    // the datetime is created server side so no sanitation is needed
    $timestamp = date('Y-m-d H:i:s');
    $set_date = strtotime($timestamp);
    $date = date("Y-m-d H:i:s", $set_date);
    
    // build SQL query to save post data in tbl_posts in database - by not quoting the variables where they could be empty they are interpreted as NULL not "NULL"
    $query = "INSERT INTO `tbl_posts` (`user_id`, `wall_id`, `post_caption`, `post_message`, `post_img`, `post_origin`, `date_time_posted`) VALUES ('$from', '$to', $title, '$contents', $image, '$origin', '$date')";

    if(mysqli_query($connection, $query)) { // run query against connected database and if successful
 
        echo "success";
        
    } else {

        trigger_error("Query: $query\n<br>MySQL Error: " . mysqli_error($connection)); // error to be handled by error handler defined in config.inc.php

    }

    closeConnection($connection); // close database connection after action is complete - defined in mysqli_connect.php
}

?>