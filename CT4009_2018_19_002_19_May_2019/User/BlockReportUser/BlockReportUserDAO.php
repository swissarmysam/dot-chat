<?php

/* *************************************************************************************** */
/* * BlockReportUserDAO.php handles:                                                     * */
/* *************************************************************************************** */

include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // get database connection script if not already loaded

function getUserList() {
    $connection = openConnection(); // connect to database
    echo '<tr class="userEntry">'; // create select tag with id of country so it can be selected in Register.js
    $query = mysqli_query($connection, 'SELECT `user_id`, `full_name`, `acc_active` FROM `tbl_members`'); // create query to select record from user_id and full_name columns
    if(mysqli_num_rows($query) > 0) { // if a record exists then...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
            // Ref: $option_row[0] = 'user_id', $option_row[1] = 'full_name', $option_row[2] = 'acc_active'
            if($option_row[0] === $_SESSION['user_id'] || $option_row[2] != 1) { // if current row user_id matches logged in user or if user account is not active then...
                // do not display record
            } else { // otherwise display user record in table
                echo "<td class='user_name'>" . $option_row[1] . "</td>"; // create table cell with full_name displayed
                echo "<td></td>"; // create a cell which will say if a follower or not
                echo "<td><a href='#'  id='follow_" . $option_row[0] . "' class='actionFollowUser'>Follow</a></td>"; // action to follow a user
                echo "<td><a href='#' id='wall_" . $option_row[0] . "' class='actionViewUserWall'>View Wall</a></td>"; // create table cell with user_id as tag id which is passed to indentify user wall
                echo "<td><a href='#'id='chat_" . $option_row[0] . "' class='actionChatMessage'>Send Message</a></td>"; // create table cell with chat-user_id as tag id which is passed to indentify chat group
                echo "<td><a href='#' id='report_" . $option_row[0] . "' class='actionReportUser'>Report User</a></td>"; // create table cell with report user action link
                echo '</tr>'; // close select tag
            }
        }
    }   
    closeConnection($connection); // close database connection
}

function viewOwnWall() {

    $id = $_SESSION['user_id'];

    echo "<p><a href='#' id='wall_" . $id . "' class='actionViewUserWall'>View Your Wall</a></p>";

}

// set the session variable to the id of the member whose profile is being interacted with

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    session_start();

    $connection = openConnection();
        
    $id = $_POST['other_id'];
    
    $_SESSION['other_id'] = $id; 
            
    closeConnection($connection);
    ob_end_clean();
    echo "success";
    exit();

}

?>