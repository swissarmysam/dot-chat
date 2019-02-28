<?php 
// **************************** SITE INFORMATION ******************************** //

/* This site was created by:
* - Samuel Rampling no. 1804867 
* - Hristo Marinov no.
* - Ben Hewlett no.
* as a group submission for:
* - CT4009 002 Assignment
* Built in 2019
*/

/* This config script:
* - defines the site settings
* - shows how errors are handled
* - defines functions that are used site-wide 
*/

// **************************** SITE SETTINGS ******************************** //

// this flag variable is used to define if the site is live for users or not. Whilst FALSE, detailed error messages are sent to the browser
define('LIVE', FALSE);

// the EMAIL variable is where the error messages will be sent to once the LIVE flag is set to TRUE
define('EMAIL', 's1804867@connect.glos.ac.uk');

// URL for redirections to build URLs ex. header('Location:' . BASE_URL .'register.php')
define('BASE_URL', 'http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/');

//set default timezone
date_default_timezone_set('Europe/London');


// **************************** ERROR HANDLING ******************************** //

// Create the event handling function expects 5 args - the err number, the err message, the script where the error occured , the line it occured 
// and an array of variables that were used at the time - the \n new line makes the message legible
// Chapter 8 (larry ullman)
function site_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {

    // Build the error message 
    $message = "An error occured in the script '$e_file' on line $e_line: $e_message\n";

    // Append date/time to the message
    $message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";

    if(!LIVE) { // if LIVE flag is FALSE then print the error 

        // show error message
        echo '<div class="warning">' . nl2br($message);

        // add variables and a backtrace
        echo "<pre>" . print_r($e_vars, 1) . "\n";
        debug_print_backtrace();
        echo "</pre></div>";

    } else { // if LIVE flag is TRUE then email the error

        $body = $message . "\n" . print_r($e_vars, 1);
        mail(EMAIL, "(dot)chat Error", $body, 'From: localhost');

        // Print error message for user if it breaks the website
        if($e_number != E_NOTICE) {
            echo '<div class="warning">A system error has occured and the admin has been notified.</div>';
        }

    }
}

// Use the above defined error handler
set_error_handler('site_error_handler');

// omit the closing php tag as it will be included in other scripts

/********************** GLOBAL FUNCTIONS *****************************/

