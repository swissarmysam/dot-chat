<?php

    require('../inc/lib/php/config.inc.php');

    $page_title = "Logout - (dot)chat";

    include('../inc/lib/php/header.html');

    include('../inc/lib/php/session.php'); // check if session exists first otherwise redirect to login

    $_SESSION = []; // Wipe the session variables

    session_destroy(); // Destroy the session

    setcookie(session_name(),'', time() - 3600); // Destroy the cookie

?>

<!-- Build the rest of the html for logout page -->

   <!-- Remove default browser styling -->
    <link rel="stylesheet" type="text/css" media="screen" href="../inc/css/Normalize.css" />

    <!-- Global styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="../inc/css/Global.css" />
    <!-- Overwrite and/or add page specific styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="../index.css" />

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

        <main>
            <?php echo "<h3>You are now successfully logged out. Thank you for visiting!</h3>"; ?>
        </main>
</div>

 <?php include('../inc/lib/php/footer.html'); ?>