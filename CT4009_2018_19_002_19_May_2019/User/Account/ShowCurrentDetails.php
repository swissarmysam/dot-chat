<?php

include_once('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php');

function showCurrentDetail($item) {
    
    $connection = openConnection(); // connect to database

    $id = $_SESSION['user_id'];

     $sql = "SELECT $item
            FROM tbl_members  
            WHERE `user_id`=$id";
  
    $query = mysqli_query($connection, $sql); // create query to select record from country_name column

    if(mysqli_num_rows($query) > 0) { // if a record exists then ...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
            echo "<span>" . $option_row[0] . "</span>";
    }

    closeConnection($connection); // close database connection
                        
    }
}

?>