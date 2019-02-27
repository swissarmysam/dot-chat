<?php

include_once('/home/s1804867saming/public_html/CT4009_2018_19_002_19_May_2019/inc/lib/php/mysqli_connect.php');

/* code below is javascript that needs converting */

//  function showWallPosts() { // put users posts back on wall 
//     selectAll(function (results) {
//         if (!results || !results.length) { // if no posts
//             // do nothing
//         } else {
//             var len = results.length,
//                 i;
//             console.log(len);
//             for (i = 0; i < len; i++) { // iterates through results of post object store
//                 if (parseInt(results[i].wallId) == currentUserId) { // if wallId and currentUserId match then
//                     if ("chosenImg" in results[i]) { // checks if the key chosenImg exists in object
//                         var img_url = window.URL.createObjectURL(results[i].chosenImg); // creates an img url that can be assigned to an img src
//                         $('.wall').prepend(
//                             `<div class="post h${results[i].postH} v${results[i].postV}"> <img src="${img_url}" /> <p>${results[i].postDate} by ${results[i].postedBy}</p> </div>`
//                         )
//                     } else {
//                         $('.wall').prepend(
//                             `<div class="post h${results[i].postH} v${results[i].postV}"> ${results[i].postContents} <br><br> ${results[i].postDate} by ${results[i].postedBy} </div>`
//                         )
//                     }
//                 }

//             }
//         }
//     });
// }; 


function showWallPosts() {

    // @session_start();
    
    $connection = openConnection(); // connect to database

    $wall = $_SESSION['other_id'];
  
    $query = mysqli_query($connection, "SELECT `post_message`, `date_time_posted` FROM `tbl_posts` WHERE `wall_id`=$wall"); // create query to select record from country_name column

    if(mysqli_num_rows($query) > 0) { // if a record exists then ...
        while($option_row = mysqli_fetch_array($query, MYSQLI_NUM)) { // fetch query result as a numbered array and assign as $option_row
          
            echo "<script>$('.wall').prepend(`<div class='post h4 v2'>" . $option_row[0] . "<br><br>  by" . $option_row[1] . "</div>`)</script>";
        
    }

    closeConnection($connection); // close database connection
                        
    }
}

?>