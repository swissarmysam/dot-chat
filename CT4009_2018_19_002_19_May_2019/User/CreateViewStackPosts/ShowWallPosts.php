<?php

/* *************************************************************************************** */
/* * ShowWallPosts.php handles:                                                          * */
/* * - display wall post with correct formatting dependent on contents                   * */
/* * - Show name of user whose wall is currently active                                  * */
/* *************************************************************************************** */

include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // load db script

function showWallPosts() { 
    
    $connection = openConnection(); // connect to database

    $wall = $_SESSION['other_id']; // wall owner id 

    // create query to select relevant wall post data from different tables
    $sql = "SELECT tbl_posts.post_message, tbl_posts.post_img, tbl_posts.date_time_posted, tbl_members.full_name 
            FROM tbl_posts INNER JOIN tbl_members ON tbl_posts.user_id=tbl_members.user_id 
            WHERE `wall_id`=$wall ORDER BY tbl_posts.date_time_posted DESC";
  
    $query = mysqli_query($connection, $sql); // create query to select record from country_name column

    if(mysqli_num_rows($query) > 0) { // if a record exists then ...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
          if($option_row[1] == NULL){ // if no image is present in variable then display with text formatting
            echo "<div class='post h4 v2'>" . $option_row[0] . "<br><br> by " . $option_row[3] . " on " . $option_row[2] . "</div>";
          } else { // otherwise create an image tag to display image
            echo "<div class='post h4 v4'><img src='uploads/" . $option_row[1] . "'><br><br> by " . $option_row[3] . " on " . $option_row[2] . "</div>";
          }
 
    }

    closeConnection($connection); // close database connection
                        
    }
}

function showWallOwner() {
    
    $connection = openConnection(); // connect to database

    $id = $_SESSION['other_id'];

    $sql = "SELECT `full_name` FROM `tbl_members` WHERE `user_id`=$id";
  
    $query = mysqli_query($connection, $sql); // create query to select record from country_name column

    if(mysqli_num_rows($query) > 0) { // if a record exists then ...
      $option_row = mysqli_fetch_array($query, MYSQLI_NUM);
      echo "<h3 class='left'>" . $option_row[0] . "'s Wall</h3>";
    }

    closeConnection($connection); // close database connection
                        
}


?>