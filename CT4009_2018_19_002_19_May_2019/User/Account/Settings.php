<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
// include('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page

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
            <a id="logoutBtn" href="http://ct4009-saming.studentsites.glos.ac.uk/CT4009_2018_19_002_19_May_2019/Login/Logout.php">Click here to logout</a>
            <br><br><br>

            <h3>Update Account Details</h3>
            
            <h4>Update Name</h4>
            <label>Current Name</label>
            <input type="text"><br>
            <label>New Name</label>
            <input type="text">

            <h4>Update Email Address</h4>
            <label>Current Email</label>
            <input type="email"><br>
            <label>New Email</label>
            <input type="email">
            
            <h4>Update Country</h4>
            <label>Current Country</label>
            <input type="text"><br>
            <label>New Country</label>
            <select class="field-text" id="country" name="country">
                <option class="field-text"></option>
            </select>
            <br>

            <h4>Update Password</h4>
            <label>Current Password</label>
            <input type="password"><br>
            <label>New Password</label>
            <input type="password"><br><br>

            <button id="updateBtn" class="btnGreen">Save Details</button>
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