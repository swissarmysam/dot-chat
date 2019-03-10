<?php

/* ******************************************************************************************************* */
/* * ShowCurrentDetails.php gets the user id from the session variable and selects the requested detail  * */
/* * from the Settings.php page.                                                                         * */
/* ******************************************************************************************************* */

include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // connect to db script

function showCurrentDetail($item) { // argument is populated from Settings.php
    
    $connection = openConnection(); // connect to database

    $id = $_SESSION['user_id']; // user id is from session variable

    $sql = "SELECT $item 
        FROM tbl_members  
        WHERE `user_id`=$id";
  
    $query = mysqli_query($connection, $sql); // create query to select record from table

    if(mysqli_num_rows($query) > 0) { // if a record exists then ...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row[0]
            echo "<span>" . $option_row[0] . "</span>"; // respond with info from table
    }

    closeConnection($connection); // close database connection
                        
    }
}

?>