<?php 

/* This script handles ajax request sent from Register.js and add the user details to the tbl_member table in the database */

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php'); // include database connection script

// build email advising user that account has been registered then send from server
function successEmail($email, $fn, $c){ // email, full name and country are passed as arguments

    // build email subject and body. Variables passed as arguments are used to populate email body with user registration details. Header is from php.ini file on server
    $to = $email; 
    $subject = "Thank you for registering on (dot)chat";
    $body = "
        Thanks for registering on (dot)chat, the best social media site for digital media professionals.

        Your account has been created and activated using the following details:

        -----------------------------------------------
        Name: $fn
        Email: $to
        Country: $c
        -----------------------------------------------

        You can login by following the link below and entering your email and the password you used to register.
        http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/

        We hope you enjoy using (dot)chat!
    ";

    $body = wordwrap($body, 70); // truncate the line length as per php.net mail() documentation

    mail($to, $subject, $body); // email sent from server to registered user

}

if($_SERVER['REQUEST_METHOD'] == 'POST') { // only save record if submit method is POST

    $connection = openConnection(); // open database connection set in mysqli_connect.php

    // Set variable values from dataString in Register.js and use use real_escape_string to prevent SQL injection with special characters
    $full_name = mysqli_real_escape_string($connection, $_POST['full_name']); // pass db connection as parameter and get full name 
    $country = $_POST['country'];  // user country (will be used to generate heat maps)
    $email = mysqli_real_escape_string($connection,$_POST['email']); // pass db connection as parameter and get email address
    $pw = mysqli_real_escape_string($connection,(password_hash($_POST['password'], PASSWORD_DEFAULT))); // pass db connection as parameter and pass password with using password_hash function using bcrypt algorithm
    $date = date('Y-m-d'); // get the date to be stored as registration date against user

    // build SQL query to save user registration in tbl_members in database
    $query = "INSERT INTO `tbl_members` (`full_name`, `country_name`, `email`, `password`, `registration_date`) VALUES ('$full_name', '$country', '$email', '$pw', '$date')";

    if(mysqli_query($connection, $query)) { // run query against connected database and if successful
        echo "Member record added successfully";
        successEmail($email, $full_name, $country); // call function to send email to registered user
    } else {
        trigger_error("Query: $query\n<br>MySQL Error: " . mysqli_error($connection)); // error to be handled by error handler defined in config.inc.php
    }

    closeConnection($connection); // close database connection after action is complete - defined in mysqli_connect.php
}


?>