<?php // this script checks if a user is logged in when visiting a page otherwise it will redirect back to login

   session_start();

   if(!isset($_SESSION['user_id'])){ // if session variable is not set from LoginDAO
      header("Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_1804867_1807874_1807431_19_May_2019/index.php"); // redirect to index
      exit(); // exit script
   }

?>