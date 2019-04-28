<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../inc/lib/php/config.inc.php');

$page_title = "Reset Status - (dot)chat";
include('../inc/lib/php/header.html');

?>

<!-- Build the rest of the html for login page -->

   <!-- Remove default browser styling -->
    <link rel="stylesheet" type="text/css" media="screen" href="../inc/css/Normalize.css" />

    <!-- Global styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="../inc/css/Global.css" />
    <!-- Overwrite and/or add page specific styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="./Reset.css" />

    <!-- Import JS libraries -->

    <!-- jQuery init -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>

    <!-- End import -->

</head>

<body>
    <!-- Div wrapper is used to apply grid on document body -->
    <div class="wrapper">

        <!-- Header section begins -->
        <header>
            <h1>(dot)chat</h1>
        </header>
        <!-- header section ends-->

        <!-- Primary Navigation Begins-->
        <?php include('../inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Main section begins -->
        <main>

            <!-- Container div begins -->
            <div class="container">
                <!-- Handle the message to be displayed based on query string value-->
                <?php if(isset($_GET['resetResult']) && $_GET['resetResult'] == 'fail'): ?>
                    <h2>Password Reset Failed</h2>

                    <p class="warning">We recommend trying a <a href="./RequestReset.php">new password reset</a>.</p>

                    <p class="warning">If this doesn't work, please contact <a href="#">support</a> with details of your full name and email address.</p>
                <?php endif; ?>

                <?php if(isset($_GET['requestResult']) && $_GET['requestResult'] == 'received'): ?>
                    <h2>We got your reset request!</h2>

                    <p class="success">Your password reset request was successful. Please check your email inbox for the reset link.</p>
                <?php endif; ?>
                
                <?php if(isset($_GET['requestResult']) && $_GET['requestResult'] == 'not-found'): ?>
                    <h2>Request Failed</h2>

                    <p class="warning">The email you entered was not found in our records. If this is an error, please contact <a href="#">support</a>.</p>
                <?php endif; ?>
                <!-- End handling of status messages -->
            </div>
            <!-- container div ends -->
        </main>
        <!-- Main section ends -->
    </div>
    <!-- Wrapper div ends -->

    <?php include('../inc/lib/php/footer.html'); ?>