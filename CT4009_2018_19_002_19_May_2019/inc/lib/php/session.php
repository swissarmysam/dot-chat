<?php // this script checks if a user is logged in when visiting a page otherwise it will redirect back to login

   if(!isset($_SESSION['user_id'])){ // if session variable is not set from LoginDAO
      header("Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/index.php"); // redirect to index
      exit(); // exit script
   }

   /* SESSION USER LEVEL CHECK FOR ADMIN PAGES */
   // call function in admin pages to check that it is an admin logged in otherwise navigate away from page
   function checkAdminStatus() {
      if($_SESSION['user_level'] == 1){ // if session variable is not set from LoginDAO
         header("Location: http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/User/BlockReportUser/BlockReportUser.php"); // redirect to standard user page
         exit(); // exit script
      }
   }

?>