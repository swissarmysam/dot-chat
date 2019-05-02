<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
include_once('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page
include_once('../../inc/lib/php/check_admin.php'); // include script to check if user is an admin
require('./ViewReportedUsersDAO.php'); // get db script for this page

$page_title = "Reported Users - (dot)chat"; // set web page title
include('../../inc/lib/php/header.html'); // include standard html head material 

?>
<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Normalize.css" />

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="./ViewReportedUsers.css" />

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
                    echo "{$_SESSION['full_name']}"; // display username
                } 
            echo "</span></h4>" ;
            ?>
        </header>
        <!-- Header section ends -->

        <!-- Primary Navigation Begins-->
        <?php include('../../inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Main section -->
        <main>
            <h2>Reported User List</h2>

            <!-- Table element to list users in database - this will be populated by BlockReportUser.js -->
            <table id="listUsers" class="active">
                <tr>
                    <th><b>Report No</b></th>
                    <th><b>Reported User</b></th>
                    <th><b>Report Reason</b></th>
                    <th><b>Report Date</b></th>
                    <th><b>Action</b></th>
                </tr>
                 <?php getReportedUserList(); ?>
            </table>
        </main>

        <!-- The Modal -->
        <div class="modal-container">
            <div class="modal-box">
                <form class="ReportedUsersAction">
                <span class="close">X</span>
                    <div class="RadioInputs">
                        <input type="radio" name="action" value="warning">Issue warning to user<br>
                        <input type="radio" name="action" value="one-day">Ban User for 24 hours<br>
                        <input type="radio" name="action" value="three-day">Ban User for 72 hours<br>
                        <input type="radio" name="action" value="ban-forever">Permanently Ban User<br>
                        <input type="radio" name="action" value="delete-report">Delete Report<br>
                    </div>
                    <button class="btn btnGreen" id="SubmitBtn">Submit</button>
                </form>
            </div>
        </div>
        <!-- Main content ends -->

    </div>

    <!-- Load javascript files -->
    <script src="./ViewReportedUsers.js"></script>

    <?php include('../../inc/lib/php/footer.html'); ?>