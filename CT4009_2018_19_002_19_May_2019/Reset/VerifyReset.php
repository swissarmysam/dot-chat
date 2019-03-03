<?php 

/* the login page is the index page for the website as users need to be logged in to utilise its functionality */

require('../inc/lib/php/config.inc.php'); // require config.inc file as it contains error handling

$page_title = "Reset Password - (dot)chat"; // set page title variable for display in header.html
include('../inc/lib/php/header.html'); // include header file 

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

<!-- Required to import in header - ZXCVBN library is used for password strength estimation. Made by Dropbox-->
<script src="../inc/lib/js/zxcvbn.js"></script>

<!-- End import -->
</head>

<body>
    <!-- Div wrapper is used to apply grid on document body -->
    <div class="wrapper">

        <!-- Header section -->
        <header>
            <h1>(dot)chat</h1>
        </header>
        <!-- Header section ends -->

        <!-- Primary Navigation Begins-->
        <?php include('../inc/lib/php/menu.html'); ?> <!-- Include menu.html file -->
        <!-- Primary navigation Ends -->

        <!-- Main section -->
        <main>
            <!-- Div container is used to apply 100% height to main section in Register.css -->
            <div class="container">

                <!-- Form header -->
                <h2>Reset Password</h2>

                <!-- Form begins -->
                <div id="warning"></div>
                <form id="userVerifyPwForm" method="post" action="./VerifyResetDAO.php"> <!-- submit form as POST as it contains user information -->

                    <!-- form-container div is a nested grid for form layout -->
                    <div class="form-container">

                        <!-- Password Entry -->
                        <label for="enter_password" class="field-label">Password</label>
                        <!-- set input type as password to notify browser that this is password entry and obsfuscate input -->
                        <input class="field-text" type="password" id="enter_assword" name="enter_password" placeholder="Enter a secure password"
                            pattern=".{8,}" required="required" onchange="this.setCustomValidity('Password should be at least 8 characters');"/>

                        <label for="confirm_password" class="field-label">Confirm Password</label>
                        <input class="field-text" type="password" id="confirm_password" name="confirm_password"
                            placeholder="Confirm the password" required="required" />

                        <!-- Password strength and complexity -->
                        <label for="pw-complexity" class="field-label">Strength: </label><span id="pw-strength">None</span>
                        <meter max="4" id="pw-complexity"></meter>

                        <!-- Submit form -->
                        <button type="submit" class="btnGreen">Reset Password</button>
                    </div>
                </form>
                <!-- Form Ends -->
            </div>
        </main>
        <!-- Main section ends -->

        <!-- Footer begins -->
        <footer>
           
        </footer>
        <!-- Footer ends -->

    </div>
    <!-- Div Wrapper ends -->

    <?php include('../inc/lib/php/footer.html'); ?> <!-- Include footer.html which flushes output buffer after page is built -->