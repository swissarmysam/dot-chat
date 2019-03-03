<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
// include('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page
require('./ViewPostsSummaryDAO.php');

$page_title = "Statistics - (dot)chat"; // set web page title
include('../../inc/lib/php/header.html'); // include standard html head material 

?>
<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Normalize.css" />

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="./ViewPostsSummary.css" />

<!-- Load font awesome cdn for icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
    crossorigin="anonymous">

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
                    echo "{$_SESSION['full_name']}, ";
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
            <!-- Title  -->
            <h2>Post Statistics and Management</h2>

            <!-- Table element to show post statistics -->
            <table id="postStats" class="active">
                <tr>
                    <th><b>Type</b></th>
                    <th><b>Result</b></th>
                    <th colspan="2"><b>Action</b></th>
                </tr>
                <?php getPostCount(); ?> <!-- Display total number of posts in tbl_posts -->
            </table>

            <!-- All posts listed in table -->
            <table id="managePosts" class="hidden">
                <!-- table is hidden by default - can be toggled by Manage action -->
                <thead>
                    <tr>
                        <th>Post ID</th>
                        <!-- <th>Post Title</th> -->
                        <th>Post Image</th>
                        <th>Post Message</th>
                        <th>Posted By User</th>
                        <th>Date Posted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php getPostDetails(); ?>
                </tbody> <!-- tbody tag for scroll -->
            </table>
        </main>

    </div>

    <!-- Load javascript files -->
    <script src="ViewPostsSummary.js"></script>

    <?php include('../../inc/lib/php/footer.html'); ?>