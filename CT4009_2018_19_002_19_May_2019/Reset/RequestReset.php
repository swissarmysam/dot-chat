<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../inc/lib/php/config.inc.php');

$page_title = "Password Reset - (dot)chat";
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

                <h2>Request Password Reset</h2>

                <div id="warning"></div>
                
                <!-- Memeber login form begins -->
                <form id="frmRequestReset" method="post" action="./RequestResetDAO.php">

                    <!-- form-container div is a nested grid for form layout -->
                    <div class="form-container">

                        <!-- User email address -->
                        <label for="userEmail">Email</label>
                        <!-- user email must match pattern defined by regex pattern, all "auto" functionality disable to mitigate input error -->
                        <input id="txtEmail" type="email" name="email" placeholder="Email" autocapitalize="none"
                            autocorrect="off" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            required="required">
               
                        <!-- submit form button handled by js -->
                        <button id="pwReset" class="btn btnGreen" type="submit">Request Reset</button>
                    </div>
                    <!-- form-container div ends -->
                </form>
                <!-- Member login form ends -->

            </div>
            <!-- container div ends -->
        </main>
        <!-- Main section ends -->
    </div>
    <!-- Wrapper div ends -->

    <?php include('../inc/lib/php/footer.html'); ?>