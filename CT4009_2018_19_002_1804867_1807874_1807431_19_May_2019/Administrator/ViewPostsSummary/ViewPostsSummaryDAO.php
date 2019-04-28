<?php

/* This script handles the database requests for ViewPostsSummary page */

 include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // get database connection script if not already loaded

/* ************************************************************************ */
/* * DISPLAY THE POST COUNT IN A TABLE AND ADD ACTIONS INC. HEATMAP LINK  * */
/* ************************************************************************ */

function getPostCount() {
    $connection = openConnection(); // connect to database
    echo '<tr>'; // create select tag with id of country so it can be selected in Register.js
    $query = mysqli_query($connection, 'SELECT `post_id` FROM `tbl_posts`');
    $number = mysqli_num_rows($query); // create query to select record from user_id and full_name columns
    if($number) { // if a record exists then...
        // fetch query result as a numbered array and assign as $option_row
        // Ref: $option_row[0] = 'user_id', $option_row[1] = 'full_name', $option_row[2] = 'acc_active'
        echo "<td id='post_num'>Post Total</td>"; // display number of total posts
        echo "<td id='post_num'>" . $number . "</td>"; // display number of total posts
        echo "<td><a href='#' class='actionManageAllPosts'>Manage Posts</a></td>"; // create table cell manage posts toggle action
        echo "<td><a href='#' class='actionShowHeatmap'>View Heatmap</a></td>"; // create table cell manage posts toggle action
        echo "</tr>"; // close select tag   
    }
    closeConnection($connection); // close database connection
}

/* ******************************************************** */
/* * DISPLAY THE POST DETAILS IN A TABLE AND ADD ACTIONS  * */
/* ******************************************************** */

function getPostDetails() {

    $connection = openConnection(); // connect to database
    $sql = "SELECT tbl_posts.post_id, tbl_posts.post_message, tbl_posts.post_img, tbl_posts.date_time_posted, tbl_members.full_name 
            FROM tbl_posts INNER JOIN tbl_members ON tbl_posts.user_id=tbl_members.user_id 
            ORDER BY tbl_posts.date_time_posted DESC";
    $query = mysqli_query($connection, $sql); 
    if(mysqli_num_rows($query) > 0) { // if a record exists then...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
            echo '<tr>';
            // Ref: $option_row[0] = 'post_id', $option_row[1] = 'user_id', $option_row[2] = 'post_img'
            echo "<td>" . $option_row[0] . "</td>"; // create table cell with post_id 
            echo "<td><img src='../../User/CreateViewStackPosts/uploads/" . $option_row[2] . "'></p></td>"; // create table cell with post image
            echo "<td><p>" . $option_row[1] . "</p></td>"; // create table cell with post message
            echo "<td><p>" . $option_row[4] . "</p></td>"; // create table cell with post sender name
            echo "<td><p>" . $option_row[3] . "</p></td>"; // create table cell with post date
            echo "<td id='" . $option_row[0] . "'><a href='#' class='actionDeletePost'>Delete Post</a></td>";
            echo '</tr>'; // close select tag 
        }
    }   
    closeConnection($connection); // close database connection

}

/* ************************************** */
/* * AJAX FULFILMENT FOR DELETING POST  * */
/* ************************************** */

if($_SERVER['REQUEST_METHOD'] == 'POST') { // if request was received as POST method
    if($_POST['delete'] == "yes"){ // check that post was intended to be deleted
        
        $post = $_POST['id']; // set post ID sent as $post var

        $connection = openConnection(); // connect to database
        $query = mysqli_query($connection, "SELECT * FROM `tbl_posts` WHERE `post_id`='$post'"); // create query to delete record from tbl_posts

        if(mysqli_num_rows($query) > 0) { // check if row matches query ...

            $result = mysqli_query($connection, "DELETE FROM `tbl_posts` WHERE `post_id`='$post'"); // Delete the post from the table
            echo "success"; // respond to request with "success" to handle next step in JS file
            closeConnection($connection); // close the database connection
            exit(); // kill the script process

        } else {

            closeConnection($connection);
            exit();

        }
    }
}   

?>