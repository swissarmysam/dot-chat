<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    $id = $_POST['id']; // get user id to handle request
    $aid = $_POST['aid']; // action id to invoke correct function 

    $connection = openConnection(); // connect to database

    if($aid == "deactivate") {
        $query = mysqli_query($connection, "SELECT * FROM `tbl_members` WHERE `user_id`='$id'"); // create query to delete record from tbl_members

        if(mysqli_num_rows($query) > 0) { // check if row matches query ...

            $result = mysqli_query($connection, "UPDATE `tbl_members` SET `acc_status`=0 WHERE `user_id`=$id");
            echo 1;
            closeConnection($connection);
            exit();

        } else {

            echo 0;
            closeConnection($connection);
            exit();

        }
    }

}   
    
?>