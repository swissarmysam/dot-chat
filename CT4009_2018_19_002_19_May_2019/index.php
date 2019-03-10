<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('inc/lib/php/config.inc.php');

$page_title = "Welcome to (dot)chat";
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
        <?php include('inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Main section begins -->
        <main>

            <!-- Container div begins -->
            <div class="container">

                <h2>Member Login</h2>
                <!-- If loginDAO returns authCheck value then display -->
                <?php if(isset($_GET['authCheck']) && $_GET['authCheck'] == 'false'): ?>
                    <div class="warning"><p>Sorry. Your email and/or password was incorrect.</p></div>
                <?php endif; ?> 
                <!-- If completeResetDAO returns pwReset value then display -->
                 <?php if(isset($_GET['pwReset']) && $_GET['pwReset'] == 'success'): ?>
                    <div class="success"><p>Your password has been reset. Please try signing in with your new password.</p></div>
                <?php endif; ?> 
                
                <!-- Memeber login form begins -->
                <form id="frmUserLogin" method="post" action="Login/LoginDAO.php">

                    <!-- form-container div is a nested grid for form layout -->
                    <div class="form-container">

                        <!-- User email address -->
                        <label for="userEmail">Email</label>
                        <!-- user email must match pattern defined by regex pattern, all "auto" functionality disable to mitigate input error -->
                        <input id="txtEmail" type="email" name="email" placeholder="Email" autocapitalize="none"
                            autocorrect="off" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            required="required">
                        <!-- information tooltip for user email address -->

                        <!-- User password field -->
                        <label for="enterPassword">Password</label>
                        <input id="txtPw" type="password" name="password" placeholder="Enter Password" required="required">
                        <!-- information tooltip for user password -->
               
                        <!-- submit form button handled by js -->
                        <button id="userLogin" class="btn btnGreen" type="submit">Login</button>
                    </div>
                    <!-- form-container div ends -->
                </form>
                <!-- Member login form ends -->

                <!-- Forgotten password link -->
                <p>Forgotten your password? <a href="http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/Reset/RequestReset.php">Password Reset</a></p>

                <!-- CTA for member account signup - link redirects user to register page -->
                <p>Need an account? <a href="http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/Register/Register.php">Sign Up</a></p>

            </div>
            <!-- container div ends -->
        </main>
        <!-- Main section ends -->
    </div>
    <!-- Wrapper div ends -->

    <?php include('inc/lib/php/footer.html'); ?>