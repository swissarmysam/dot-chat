<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
// include('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page

include_once("./ShowCurrentDetails.php");

$page_title = "Account Settings - (dot)chat"; // set web page title
include('../../inc/lib/php/header.html'); // include standard html head material 

?>
<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Normalize.css" />

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="Settings.css" />

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
            ?>
        </header>
        <!-- Header section ends -->

        <!-- Primary Navigation Begins-->
        <?php include('../../inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Main section -->
        <main>
            <h2>Account Options</h2>
            <br>

            <h3>Logout from (dot)chat</h3>
            <a id="logoutBtn" href="http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_1804867_1807874_1807431_19_May_2019/Login/Logout.php">Click here to logout</a>
            <br><br><br>

            <h3>Update Account Details</h3>
            
            <h4>Update Name</h4>
            <label>Current Name: </label>
            <?php showCurrentDetail('full_name'); ?>
            <br>
            <form name="updateName" method="post" action="updateNameDAO.php">
                <label>New Name</label>
                <input type="text">
                <br>
                <button class="btn btnGreen" type="submit">Update Name</button>
            </form>

            <h4>Update Email Address</h4>
            <label>Current Email: </label>
            <?php showCurrentDetail('email'); ?>
            <br>
            <form name="updateEmail" method="post" action="updateEmailDAO.php">
                <label>New Email</label>
                <input type="email">
                <br>
                <button class="btn btnGreen" type="submit">Update Email</button>
            </form>
            
            <h4>Update Country</h4>
            <label>Current Country: </label>
            <?php showCurrentDetail('country_name'); ?>
            <br>
            <form name="updateCountry" method="post" action="updateCountryDAO.php">
            <label>New Country</label>
            <?php 
                include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // get database connection script
                $connection = openConnection(); // connect to database
                echo '<select class="field-text" id="country" name="country">'; // create select tag with id of country so it can be selected in Register.js
                $query = mysqli_query($connection, 'SELECT `country_name` FROM `tbl_countries`'); // create query to select record from country_name column
                if(mysqli_num_rows($query) > 0) { // if a record exists then ...
                    while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
                        echo '<option class="field-text" name="country_name" value="' . $option_row[0] . '">' . $option_row[0] . '</option>'; // create option tag with returned value from array
                    }
                }
                echo '</select>'; // close select tag
                closeConnection($connection); // close database connection
            ?>
            <br>
            <button class="btn btnGreen" type="submit">Update Country</button>
            </form>
            <br>

            <h4>Update Password</h4>
            <form name="updatePassword" method="post" action="updatePasswordDAO.php">
            <label>Current Password</label>
            <input type="password"><br>
            <label>New Password</label>
            <input type="password"><br><br>
            <button id="updateBtn" class="btnGreen">Update Password</button>
            </form>
            <br><br><br>

            <h3>Deactivate my account</h3>
            <a id="deactivateBtn" href="#">Deactivate</a>
            <br><br>
            <h3>Delete my account</h3>
            <p>We're sorry that you want to leave us but if you would like to delete your account, then please <a href="#">contact support</a> to request this.</p>
            <br><br>


        </main>

    </div>

    <!-- Load javascript files -->
    <script src="./Settings.js"></script>

    <?php include('../../inc/lib/php/footer.html'); ?>