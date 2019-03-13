<?php

/* *************************************************************************************** */
/* * ChatMessageDAO.php handles:                                                         * */
/* * - The user interaction and saves messsages to table                                 * */
/* *************************************************************************************** */

include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // db script

/* Function to save data to tbl_posts */

if($_SERVER['REQUEST_METHOD'] == 'POST') { // only save record if submit method is POST

    $connection = openConnection(); // open database connection set in mysqli_connect.php

    // Set variable values from dataString in Register.js and use use real_escape_string to prevent SQL injection with special characters
    $to = mysqli_real_escape_string($connection, $_POST['to']); // pass db connection as parameter and get wall id where post is being made
    $from = mysqli_real_escape_string($connection, $_POST['from']);  // user id who posted to the wall
    $timestamp = date('Y-m-d H:i:s');
    $set_date = strtotime($timestamp);
    $date = date("Y-m-d H:i:s", $set_date); // get datetime in compatible format for mySQL table
    $message = mysqli_real_escape_string($connection, htmlspecialchars($_POST['message'])); // sanitise message

    // build SQL query to save post data in tbl_posts in database - by not quoting the variables where they could be empty they are interpreted as NULL not "NULL"
    $query = "INSERT INTO `tbl_messages` (`msg_to_id`, `msg_from_id`, `msg_date_time`, `msg_text`) VALUES ('$to', '$from', '$date', '$message')";

    if(mysqli_query($connection, $query)) { // run query against connected database and if successful
 
        echo "true"; // respond with true
        
    } else {

        // fail handled by ChatMessage.js
        trigger_error("Query: $query\n<br>MySQL Error: " . mysqli_error($connection)); // error to be handled by error handler defined in config.inc.php

    }

    closeConnection($connection); // close database connection after action is complete - defined in mysqli_connect.php
}

?>