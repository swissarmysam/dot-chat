<?php 

// the login page is the index page for the website as users need to be logged in to utilise its functionality

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
// include('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page

include_once("./ShowMessages.php");

$page_title = "Chat - (dot)chat"; // set web page title
include('../../inc/lib/php/header.html'); // include standard html head material 

?>
<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Normalize.css" />

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="./ChatMessage.css" />

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
                } else {
                    echo "{$_SESSION['user_id']}";
                }
            echo "</span></h4>";
            echo "<span class='user hidden-id' id='" . $_SESSION['user_id'] . "'></span>";
            ?>
        </header>
        <!-- Header section ends -->

        <!-- Primary Navigation Begins-->
        <?php include('../../inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->
        
        <!-- Main section -->
        <main>
            <div class="identifier">
                <?php showChatToName(); ?>
            </div>
            <div class="message">
                <?php showMessages(); ?>
            </div>
            <div class="text">
                <form method="post">
                    <textarea id="msg_contents" type="text" rows="1" cols="60" name="message" required></textarea>
                    <button id="send_msg" class="btn btnGreen">Send</button>
                </form>
            </div>
        </main>

    </div>

    <!-- Load javascript files -->
    <script src="./ChatMessage.js"></script>

    <?php include('../../inc/lib/php/footer.html'); ?>