<?php

include_once('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php');

function showMessages() {

    // @session_start();
    
    $connection = openConnection(); // connect to database

    $chat_id = $_SESSION['other_id'];
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT tbl_messages.msg_text, tbl_messages.msg_date_time, tbl_members.full_name 
            FROM tbl_messages INNER JOIN tbl_members ON tbl_messages.msg_from_id=tbl_members.user_id 
            WHERE `msg_to_id`=$chat_id AND msg_from_id=$user_id";
  
    $query = mysqli_query($connection, $sql); 
    if(mysqli_num_rows($query) > 0) { // if a record exists then ...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
          
            echo "<script>$('.message').prepend(`<p class='msg'>" . $option_row[0] . "<br><br>  Sent: " . $option_row[1] . " by " . $option_row[2] . " </p>`)</script>";
        
    }

    closeConnection($connection); // close database connection
                        
    }
}

?>