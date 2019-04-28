<?php 

// the error page is a standard error page for users 

require('inc/lib/php/config.inc.php');

$page_title = "Error - (dot)chat";
include('inc/lib/php/header.html');

?>

<!-- Build the rest of the html for login page -->

   <!-- Remove default browser styling -->
    <link rel="stylesheet" type="text/css" media="screen" href="inc/css/Normalize.css" />

    <!-- Global styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="inc/css/Global.css" />
    <!-- Overwrite and/or add page specific styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="index.css" />

    <!-- Import JS libraries -->

    <!-- jQuery init -->
   <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script> -->

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
        <?php include('inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Main section begins -->
        <main>

            <!-- Container div begins -->
            <div class="container">

                <h2>Uh oh!</h2>

                <p>An error has been detected but don't panic!</p>

                <p><a href="#" onclick="window.history.back();">Go back</a> to the previous page or <a href="#">contact support</a> for help!</p>

            </div>
            <!-- container div ends -->
        </main>
        <!-- Main section ends -->
    </div>
    <!-- Wrapper div ends -->

    <?php include('inc/lib/php/footer.html'); ?>