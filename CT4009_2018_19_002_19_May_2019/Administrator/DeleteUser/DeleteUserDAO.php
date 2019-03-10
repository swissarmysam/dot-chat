<?php

/* ************************************************************************************ */
/* * DeleteUserDAO.php handles account delete requests  and has two functions.        * */
/* * showMemberCount() counts the number of records in tbl_members and                * */
/* * displayUserRecords() populates the table with member records and a delete option * */
/* ************************************************************************************ */

include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // get database connection script if not already loaded

function showMemberCount() {
    // build user record display html
    $connection = openConnection(); // connect to database
    echo '<tr class="userEntry">'; // create select tag with id of country so it can be selected in Register.js
    $query = mysqli_query($connection, 'SELECT `user_id` FROM `tbl_members`');
    $number = mysqli_num_rows($query); // create query to select record from user_id and full_name columns
    if($number) { // if a record exists then...
        echo "<h3>Number of registered users: " . ($number - 1) . "</h3>"; // display number of registered users minus logged in user
    }
    closeConnection($connection); // close database connection

}

function displayUserRecords() {

    // build user record display html
    $connection = openConnection(); // connect to database
    echo '<tr class="userEntry">'; // create select tag 
    $query = mysqli_query($connection, 'SELECT `user_id`, `full_name`, `country_name`  FROM `tbl_members`'); // create query to select record from user_id and full_name columns
    if(mysqli_num_rows($query) > 0) { // if a record exists then...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
            // Ref: $option_row[0] = 'user_id', $option_row[1] = 'full_name', $option_row[2] = 'country_name'
            if($option_row[0] === $_SESSION['user_id']) { // if current row user_id matches logged in user or if user account is not active then...
                // do not display record
            } else { // otherwise display user record in table
            echo "<td class='user_name'>" . $option_row[1] . "</td>"; // create table cell with full_name displayed
            echo "<td class='country_name'>" . $option_row[2] . "</td>"; // create table cell with full_name displayed
            echo "<td id='" . $option_row[0] . "'><a href='#' class='actionDeleteUser'>Delete User</a></td>"; // create table cell with user_id as id and delete user link
            echo '</tr>'; // close select tag
            }
        }
    }   
    closeConnection($connection); // close database connection

}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    $id = $_POST['id']; // get user id from request

    $connection = openConnection(); // connect to database
    $query = mysqli_query($connection, "SELECT * FROM `tbl_members` WHERE `user_id`='$id'"); // create query to delete record from tbl_members

    if(mysqli_num_rows($query) > 0) { // check if row matches query ...

        $result = mysqli_query($connection, "DELETE FROM `tbl_members` WHERE `user_id`='$id'"); // remove the record
        echo 1; // success response
        closeConnection($connection);
        exit();

    } else {

        echo 0; // fail response
        closeConnection($connection);
        exit();

    }
}   
    

?>