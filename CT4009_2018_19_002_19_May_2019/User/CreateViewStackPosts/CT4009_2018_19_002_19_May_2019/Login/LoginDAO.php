<?php

/* ******************************************************************************************************* */
/* * LoginDAO.php handles user and administrator logins:                                                 * */
/* * - It sanitizes the submission and checks that a record exists in tbl_member                         * */
/* * - It checks that the acc_active value is set to 1                                                   * */
/* * - Check that the user is not banned                                                                 * */
/* ******************************************************************************************************* */

include(__DIR__ . '/../inc/lib/php/mysqli_connect.php');

$connection = openConnection();

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['password']) && !empty($_POST['password'])) { // if a value exists in sent data
        // Set variable values
        $email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['email']));
        $password = mysqli_real_escape_string($connection, htmlspecialchars($_POST['password']));

        $result = mysqli_query($connection, "SELECT `user_id`, `full_name`, `country_name`, `password`, `user_level` FROM `tbl_members` WHERE email='$email' AND acc_active=1") or die(mysqli_error($connection));

        if(@mysqli_num_rows($result) == 1) { // if a match was found

            // list is a shortcut for assigning variables ie. $user_id = $row[0]
            list($user_id, $full_name, $country_name, $hash_pw, $user_level) = mysqli_fetch_array($result, MYSQLI_NUM);
            mysqli_free_result($result);
            
            if(password_verify($password, $hash_pw)) { // check that hashed passwords match
                $_SESSION['user_id'] = $user_id; // used to record user who is signed and for site activity
                $_SESSION['user_level'] = $user_level; // used to make sure correct links are shared to user and that no destructive action can be carried out
                $_SESSION['full_name'] = $full_name; // used to display welcome message
                $_SESSION['country_name'] = $country_name; // used to store data about post location for heatmap
                // setcookie("user_id", $user_id, time() + 3600);
                // setcookie("user_name", $full_name, time() + 3600);
                closeConnection($connection);

                header("Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/User/BlockReportUser/BlockReportUser.php"); // redirect user to defacto dashboard
                ob_end_clean();
                exit();
            } else { // return to login page with query string authCheck=false
                 header("Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/index.php?authCheck=false"); 
                 closeConnection($connection);
                 exit();
            }

        } else {

           // return false; 
           header("Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/index.php?authCheck=false"); // display error page
           closeConnection($connection);
           exit();
          
        }

    }

}

?>