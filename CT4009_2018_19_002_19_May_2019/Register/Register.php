<?php 

/* the login page is the index page for the website as users need to be logged in to utilise its functionality */

require('../inc/lib/php/config.inc.php'); // require config.inc file as it contains error handling

$page_title = "Register - (dot)chat"; // set page title variable for display in header.html
include('../inc/lib/php/header.html'); // include header file 

?>

<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../inc/css/Normalize.css" /> 

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="Register.css" />

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
                <h2>Member Registration</h2>

                <!-- Form begins -->
                <div id="warning"></div>
                <form id="userRegisterForm" method="post"> <!-- submit form as POST as it contains user information -->

                    <!-- form-container div is a nested grid for form layout -->
                    <div class="form-container">

                        <!-- Full Name -->
                        <label for="full_name" class="field-label">Full Name</label>
                        <input class="field-text" type="text" id="full_name" name="full_name" placeholder="Enter full name eg. Alex Smith"
                            required="required" />

                        <!-- Email Address -->
                        <!-- regex expects pattern to be fuliflled before submission can be accepted, "auto" functionality disable to mitigate chance of input error-->
                        <label for="user_email" class="field-label">Email</label>
                        <input class="field-text" type="email" id="user_email" name="user_email" placeholder="Enter your email address eg. alex@smith.com"
                            autocapitalize="none" autocorrect="off" autocomplete="off" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                            required="required" />

                        <!-- Location -->
                        <?php 
                            include_once(__DIR__ . '/../inc/lib/php/mysqli_connect.php'); // get database connection script
                            $connection = openConnection(); // connect to database
                            echo '<label for="country" class="field-label">Country</label>'; // create label for select/option tag
                            echo '<select class="field-text" id="country" name="country">'; // create select tag with id of country so it can be selected in Register.js
                            $query = mysqli_query($connection, 'SELECT `country_name` FROM `tbl_countries`'); // create query to select record from country_name column
                            if(mysqli_num_rows($query) > 0) { // if a record exists then ...
                                while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
                                    echo '<option class="field-text" value="' . $option_row[0] . '">' . $option_row[0] . '</option>'; // create option tag with returned value from array
                                }
                            }
                            echo '</select>'; // close select tag
                            closeConnection($connection); // close database connection
                        ?>

                      
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

                        <!-- Terms and conditions acceptance - required to continue to submission -->
                        <input type="checkbox" id="acceptConditions" name="acceptConditions" /><span>I
                            accept the User
                            Agreement and understand <br> Privacy and Cookie Policy applies.</span>

                        <!-- Submit form -->
                        <button id="send" class="btnGreen" onclick="validateInputFields()">Create My Account</button>
                    </div>
                </form>
                <!-- Form Ends -->

                <!-- Link for users that have already created an account -->
                <p id="accountExists">Already have an account? <a href="../index.php">Login here</a></p>
            </div>
        </main>
        <!-- Main section ends -->

        <!-- Footer begins -->
        <footer>
            <p>Thanks for visiting!</p>
        </footer>
        <!-- Footer ends -->

    </div>
    <!-- Div Wrapper ends -->

    <!-- Load page javascript files -->
    <script src="Register.js"></script>

    <?php include('../inc/lib/php/footer.html'); ?> <!-- Include footer.html which flushes output buffer after page is built -->