<?php

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php');

$connection = openConnection();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['email']) && !empty($_POST['email'])) { // if a value exists in sent data
        // Set variable values
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        $result = mysqli_query($connection, "SELECT `user_id`, `email` FROM `tbl_members` WHERE email='$email'") or die(mysqli_error($connection));

        if(@mysqli_num_rows($result) == 1) { // if a match was found

            // list is a shortcut for assigning variables ie. $user_id = $row[0]
            list($user_id, $user_email) = mysqli_fetch_array($result, MYSQLI_NUM);
            mysqli_free_result($result);
            
            $token = openssl_random_pseudo_bytes(16);
            $token = bin2hex($token);

            $timestamp = date('Y-m-d H:i:s');
            $set_date = strtotime($timestamp);
            $date = date("Y-m-d H:i:s", $set_date);

            $sql = "INSERT INTO `tbl_password_reset_request` (`user_id`, date_time_requested, token) VALUES ($user_id, '$date', '$token')";
            $query = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            $reset_id = mysqli_insert_id($connection);

            $verifyLocation = "http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_1804867_1807874_1807431_19_May_2019/Reset/VerifyResetDAO.php";
            $sendLink = $verifyLocation . '?uid=' . $user_id . '&id=' . $reset_id . "&request=" . $token;

            $subject = "Password Reset - (dot)chat";
            
            $body = "
                A password reset has been requested for $user_email on (dot)chat.

                You can reset your password by following the link below and entering a new password:
                $sendLink

                If you did not request this password reset then you can safely ignore this email.
            ";

            $body = wordwrap($body, 70); // truncate the line length as per php.net mail() documentation
          

            mail($user_email, $subject, $body);

            closeConnection($connection);
            header('Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_1804867_1807874_1807431_19_May_2019/Reset/ResetStatus.php?requestResult=received');
            exit();

        } else {

           // return false; 
           closeConnection($connection);
           header('Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_1804867_1807874_1807431_19_May_2019/Reset/ResetStatus.php?requestResult=not-found');
           exit();
          
        }

    }

}

?>