<?php

include_once('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php'); // get database connection script if not already loaded

function getReportedUserList() {

    $connection = openConnection(); // connect to database
    echo '<tr class="userEntry">'; // create select tag with id of country so it can be selected in Register.js
    $sql = "SELECT tbl_reports.report_id, tbl_members.full_name, tbl_report_reasons.reason_desc, tbl_reports.date_time_reported, tbl_reports.user_id
            FROM tbl_reports JOIN tbl_members ON tbl_reports.user_id=tbl_members.user_id 
            JOIN tbl_report_reasons ON tbl_reports.report_reason=tbl_report_reasons.reason_id
            ORDER BY tbl_reports.date_time_reported DESC";
    $query = mysqli_query($connection, $sql); // create query to select record from user_id and full_name columns
    if(mysqli_num_rows($query) > 0) { // if a record exists then...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
            // Ref: $option_row[0] = 'user_id', $option_row[1] = 'full_name', $option_row[2] = 'acc_active'
            echo "<td>" . $option_row[0] . "</td>"; // create table cell user_id as id and report_id as a report number
            echo "<td>" . $option_row[1] . "</td>"; // create table cell with reported users name
            echo "<td>" . $option_row[2] . "</a></td>"; // create table cell with report description
            echo "<td>" . $option_row[3] . "</a></td>"; // create table cell with report date
            echo "<td id='" . $option_row[4] . "'><a href='#' class='actionManageReport'>Manage Report</a></td>"; // create table cell with handle report options
            echo '</tr>'; // close select tag
        }
    }
    closeConnection($connection); // close database connection

}

function warning($id) {

    $connection = openConnection(); // connect to database

    $query = mysqli_query($connection, "SELECT `full_name`, `email` FROM `tbl_members` WHERE `user_id`=$id"); // create query to delete record from tbl_posts

    if(mysqli_num_rows($query) > 0) { // check if row matches query ...

        list($full_name, $email) = mysqli_fetch_array($query, MYSQLI_NUM);

        $to = $email; 
        $subject = "A user has reported you on (dot)chat";
        $body = "
        Hi $full_name,

        One of our members has reported your behaviour on (dot)chat.

        We want to keep (dot)chat as friendly as possible so this is a warning that any further negative 
        actions on your behalf could result in a ban.

        Please help us keep (dot)chat a positive place to meet like-minded people, grow professionally and have fun. 

        If you feel like you have been wrongly reported, then please contact support to raise your concerns:
        http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/Support.php

        We appreciate you taking this message on-board!

        All the best,
        The (dot)chat team
        ";

        $body = wordwrap($body, 70); // truncate the line length as per php.net mail() documentation

        mail($to, $subject, $body); // email sent from server to registered user
        closeConnection($connection); // close the database connection
        exit(); // kill the script process

    } else {

        closeConnection($connection);
        echo "fail";
        exit();

    }
}   


function tempBan($id, $length) {

    $connection = openConnection(); // connect to database
    
    // $query = mysqli_query($connection, "UPDATE `tbl_members` SET `banned_until`=$until WHERE `user_id`=$id"); // create query to delete record from tbl_posts

    if(mysqli_affected_rows($connection) > 0) { // check if row matches query ...

        // sendNotice($until);
        echo "success"; // respond to request with "success" to handle next step in JS file
        closeConnection($connection); // close the database connection
        exit(); // kill the script process

    } else {

        closeConnection($connection);
        echo "fail";
        exit();

    }
}

function totalBan($id) {

    $connection = openConnection(); // connect to database
    
    $query = mysqli_query($connection, "UPDATE `tbl_members` SET acc_active=0 WHERE `user_id`=$id"); // create query to delete record from tbl_posts

    if(mysqli_affected_rows($connection) > 0) { // check if row matches query ...

        echo "success"; // respond to request with "success" to handle next step in JS file
        closeConnection($connection); // close the database connection
        exit(); // kill the script process

    } else {

        closeConnection($connection);
        echo "fail";
        exit();

    }
}

function deleteReport($rid) {

}

if($_SERVER['REQUEST_METHOD'] == 'POST') { // if request was received as POST method
    
    $action = $_POST['action']; // check that post was intended to be deleted
    $uid = $_POST['uid']; // set post ID sent as $post var

    switch ($action) {
        case "warning":
            warning($uid);
            break;
        
        case "one-day":

            break;
        
        case "three-day":

            break;
        
        case "ban-forever":
            totalBan($uid);
            break;

        case "delete-report":

            break;
        
        default:
            exit;
            // no action taken

    }
}

?>