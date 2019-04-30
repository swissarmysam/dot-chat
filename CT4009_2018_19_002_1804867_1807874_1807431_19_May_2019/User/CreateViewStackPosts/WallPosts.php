<?php 

// the wall post page is a public location to store text, images and locations of interest

require('../../inc/lib/php/config.inc.php'); // include site-wide functionality 
include_once('../../inc/lib/php/session.php'); // include script to check if a session is active (i.e. user is logged in) otherwise redirect to login page

include_once("./ShowWallPosts.php");

$page_title = "Stack - (dot)chat"; // set web page title
include('../../inc/lib/php/header.html'); // include standard html head material 

?>
<!-- Build the rest of the html for login page -->
<!-- Remove default browser styling -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Normalize.css" />

<!-- Global styles -->
<link rel="stylesheet" type="text/css" media="screen" href="../../inc/css/Global.css" />

<!-- Overwrite and/or add page specific styles -->
<link rel="stylesheet" type="text/css" media="screen" href="WallPosts.css" />

<!-- Font Awesome icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<!-- Import JS libraries -->

<!-- jQuery init -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

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
                    echo "{$_SESSION['full_name']}";
                }
            echo "</span></h4>";
            echo "<span class='user hidden-id' id='" . $_SESSION['user_id'] . "'></span>";
            echo "<span class='country hidden-id' id='" . $_SESSION['country_name'] . "'></span>";
            ?>
        </header>
        <!-- Header section ends -->

        <!-- Primary Navigation Begins-->
        <?php include('../../inc/lib/php/menu.html'); ?>
        <!-- Primary navigation Ends -->

        <!-- Wall actions secondary navigation begins -->
        <div class="nav-container">
            <nav id="wall-actions">
                <ul>
                    <li id="comment-post"><i class="fas fa-comments"></i>Comment</li> <!-- Comment Posts action -->
                    <li id="image-post"><i class="fas fa-images"></i>Image</li> <!-- Image Posts action -->
                    <li id="loc-post"><i class=" fas fa-map"></i>Location</li> <!-- Location Posts action -->
                </ul>
            </nav>
            <?php showWallOwner(); ?>
        </div>
        <!-- Wall action secondary navigation ends -->

        <!-- Comment Posts action - event handled by WallPosts.js -->
        <div id="txtPost" class="action">
            <form>
                <textarea id="txtComment" type="text" rows="5" cols="60"></textarea> <!-- set text area size -->
                <br>
                <button id="saveTextBtn">Save Message</button>
            </form>
        </div>

        <!-- Image Posts action - event handled by WallPosts.js -->
        <div id="imgPost" class="action">
            <form enctype="multipart/form-data" method="post" action="SaveImageDAO.php">
                <input id="fileInput" class="image" type="file" name="image" /> <!-- file selection input -->
                <img id="fileImagePreview" src=""> <!-- empty image tag for file preview populated by built img_url-->
                <br>
                <button type="submit" id="saveImgBtn">Save Image</button>
            </form>
        </div>

        <!-- Map Posts action - event handled by WallPosts.js -->
        <div id="mapPost" class="action">
            <div id="mapInput"></div> <!-- show map -->
            <br>
            <button id="saveLocBtn">Save Location</button>
        </div>


        <!-- Post actions ends -->
    </div>
    <!-- wrapper div ends -->

    <!-- Wall section begins - blank as elements and classes are inserted by php -->
    <section class="wall">

        <?php showWallPosts(); ?>

    </section>
    <!-- Wall section ends -->


    <!-- Load javascript files -->
    <script src="./WallPosts.js"></script>
    <script src="./advert.js"></script>

    <?php include('../../inc/lib/php/footer.html'); ?>