<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
require('./DeleteUserDAO.php'); //include database access functions for Delete User page
// include('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page

$page_title = "Delete User - (dot)chat"; // set web page title
include('../../inc/lib/php/header.html'); // include standard html head material 

?>
<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Normalize.css" />

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="DeleteUser.css" />

<!-- Import JS libraries -->

<!-- jQuery init -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    crossorigin="anonymous"></script>

<!-- End import -->
</head>

<body>
    <!-- Div wrapper is used to apply grid on document body -->
    <div class="wrapper">

        <!-- Header section -->
        <header>
            <h1>(dot)chat</h1>
            <?php echo "<h4>Welcome, <span>";
                if(isset($_SESSION['full_name'])) {
                    echo "{$_SESSION['full_name']}";
                } 
            echo "</span></h4>";
            ?>
        </header>
        <!-- Header section ends -->

        <!-- Primary Navigation Begins-->
        <?php include('../../inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Main section -->
        <main>
            <h2>User List</h2>

             <?php showMemberCount(); ?> <!-- Get number of registered members and display value -->

            <!-- Table element to list users in database - this will be populated by BlockReportUser.js -->
            <table id="listUsers" class="active">
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Country</b></th>
                    <th><b>Actions</b></th>
                </tr>
                 <?php displayUserRecords(); ?> <!-- Populate the table with user records and actions -->
            </table>
        </main>

    </div>

    <!-- Load javascript files -->
    <script src="./DeleteUser.js"></script>

    <?php include('../../inc/lib/php/footer.html'); ?>