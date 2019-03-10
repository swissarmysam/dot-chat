<?php 

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
// include('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page
require('./BlockReportUserDAO.php');

$page_title = "Dashboard - (dot)chat"; // set web page title
include('../../inc/lib/php/header.html'); // include standard html head material 

?>
<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Normalize.css" />

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="BlockReportUser.css" />

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
                    echo "{$_SESSION['full_name']} ";
                } 
            echo "</span></h4>";
            echo "<span class='hidden-id' id='" . $_SESSION['user_id'] . "'></span>";
            ?>
        </header>
        <!-- Header section ends -->

        <!-- Primary Navigation Begins-->
        <?php include('../../inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Main section -->
        <main>
            <h2>User List</h2>
            
            <?php viewOwnWall(); ?>

            <!-- Table element to list users in database - this will be populated by BlockReportUser.js -->
            <table id="listUsers" class="active">
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Following</b></th>
                    <th colspan="4"><b>Actions</b></th>
                    <!-- span 4 columns for follow, wall, chat, report action choices that will be added by DAO code -->
                </tr>
                 <?php getUserList(); ?>
            </table>
        </main>

         <!-- The Modal -->
        <div class="modal-container">
            <div class="modal-box">
                <form class="reportReasonForm">
                <span class="close">X</span>
                    <div class="RadioInputs">
                        <!-- Report type options -->
                        <input type="radio" name="report-type" value="1"><p>Posting inappropriate content</p><br>
                        <input type="radio" name="report-type" value="2"><p>Fake Account</p><br>
                        <input type="radio" name="report-type" value="3"><p>Targetted Harrassment</p><br>
                        <input type="radio" name="report-type" value="4"><p>Abusive/Harmful Behaviour</p><br>
                    </div>
                    <button class="btn btnGreen" id="SubmitBtn">Submit</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Load javascript files -->
    <script src="./BlockReportUser.js"></script>

    <?php include('../../inc/lib/php/footer.html'); ?>