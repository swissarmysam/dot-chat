<?php

include_once('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php'); // get database connection script if not already loaded

function getReportedUserList() {

    $connection = openConnection(); // connect to database
    echo '<tr class="userEntry">'; // create select tag with id of country so it can be selected in Register.js
    $query = mysqli_query($connection, 'SELECT `report_id`, `user_id`, `report_reason`, `date_time_reported` FROM `tbl_reports`'); // create query to select record from user_id and full_name columns
    if(mysqli_num_rows($query) > 0) { // if a record exists then...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
            // Ref: $option_row[0] = 'user_id', $option_row[1] = 'full_name', $option_row[2] = 'acc_active'
            echo "<td class='" . $option_row[1] . "'>" . $option_row[0] . "</td>"; // create table cell user_id as id and report_id as a report number
            echo "<td>" . $option_row[2] . "</td>"; // create table cell with report reason description
            echo "<td>" . $option_row[3] . "</a></td>"; // create table cell with date report was raised
            echo "<td><a href='#' class='actionManageReport'>Manage Report</a></td>"; // create table cell with handle report options
            echo '</tr>'; // close select tag
        }
    }
    closeConnection($connection); // close database connection

}

?>