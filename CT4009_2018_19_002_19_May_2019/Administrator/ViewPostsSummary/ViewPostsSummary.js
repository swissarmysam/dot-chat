/* ******************************************************************************* */
/* * ViewPostsSummary.js handles interactivity on the ViewPostsSummary.php page  * */
/* * and also makes ajax requests to the table to update the tbl_post contents   * */
/* * It also has the code to show the Google Map heatmap of the post origins     * */
/* ******************************************************************************* */


/* *************************************************************** */
/* * HANDLE MANAGE POSTS LINK AND ADD CLASS TO MANAGE POSTS DIV  * */
/* *************************************************************** */

$('.actionManageAllPosts').click(function(){ // if manage button is clicked
    $("#managePosts").toggleClass("active"); // make manage posts visible or hidden by toggling active class
});

/* ************************************************************************************* */
/* * HANDLE DELETE POST LINKS, VALIDATE INTENT, SEND AJAX REQUEST AND HANDLE RESPONSE  * */
/* ************************************************************************************* */

$('.actionDeletePost').click(function () { // when clicked
    let row = $(this); // the row which is being clicked
    let postID = parseInt($(this).closest('td').attr('id')); // get post ID from id attribute and immediately convert to integer

    // prompt user to confirm that post should be deleted - this is a nuclear delete, users can soft delete posts
    let confirmDelete = confirm("Click OK to delete this post. \nWarning: Deleting a post is permanent and cannot be undone.");

    if (confirmDelete == true) { // check that OK was clicked in the confirm prompt

        $.ajax({ // create an ajax request
            type: "POST",
            url: "ViewPostsSummaryDAO.php",
            data: {
                delete: "yes",
                id: postID
            }
        }).done(function (response) { // when server responds after actioning request
            if (response == "success") { // check response value matches "success"
                alert(`Post ID ${postID} successfully deleted`); // advise admin that the post was deleted
                row.closest('tr').css('background', 'red'); // set row background to red
                row.closest('tr').fadeOut(750, function () {
                    $(this).remove(); // remove the table row with a fade animation
                })
            } else {
                alert(`An error occurred and ${postID} has not been deleted. Please try again.`); // advise admin that the post was not deleted due to an error
            }
        });

    } else {
        // inform admin that the process was cancelled and then exit the function
        alert(`Deleting Post ID ${postID} failed. Please try again.`);
    }

    return false;
});

// SCRIPT ENDS