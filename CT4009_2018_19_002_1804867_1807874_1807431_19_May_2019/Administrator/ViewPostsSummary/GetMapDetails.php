<?php 

include_once(__DIR__ . '/../../inc/lib/php/mysqli_connect.php'); // get database connection script if not already loaded

/* ************************************************ */
/* * GET POST CO-ORDINATES TO BUILD HEATMAP       * */
/* ************************************************ */

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    
    $connection = openConnection(); // connect to database

    $query = "SELECT tbl_countries.lat, tbl_countries.lng 
            FROM tbl_countries INNER JOIN tbl_posts 
            ON tbl_countries.country_name = tbl_posts.post_origin";

    $result = mysqli_query($connection, $query);

    while($option_row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = $option_row;
    }

    echo json_encode($data);
}

?>