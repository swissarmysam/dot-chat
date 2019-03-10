/* ******************************************************************************* */
/* * DeleteUser.js allows the admin to delete user accounts permanently          * */
/* * It will provide a prompt to confirm the action then send an ajax request    * */
/* * If the delete was successful it will remove the row from the table          * */
/* ******************************************************************************* */


//Event handler for each "Delete User" action
$('.actionDeleteUser').click(function () { // when clicked
    let row = $(this); // grab the row contents
    let username = $(this).closest('td').siblings('.user_name').text(); // get text contents of td (username) 
    let deleteID = parseInt($(this).closest('td').attr('id')); // get user key ID and immediately convert to integer
    // console.log(userID);

    // prompt user to type delete to confirm user account should be deleted.
    let confirmDelete = prompt("Please type the word 'delete' to confirm user deletion. \nWarning: Deleting an account is permanent and cannot be undone.");

    if (confirmDelete == 'delete') { // check that the word delete was typed correctly.

        
        $.ajax({
            type: "POST", // send method
            url: "DeleteUserDAO.php", // script to handle ajax request
            data: {id: deleteID} // data to send with request (user id)
        }).done(function(response){ // get echo response from server
            if(response == 1){ // if response is 1
                alert(`${username} successfully deleted`); // alert message
                row.closest('tr').css('background', 'red'); // change row to red
                row.closest('tr').fadeOut(750, function(){ // fade out row animation
                    $(this).remove(); // remove the row
                })
            } else {
                alert(`An error occurred and ${username} has not been deleted. Please try again.`); // if the delete failed, show alert
            }
        });
        
    } else {
        // inform admin that the process was cancelled and then exit the function
        alert(`The delete process was stopped. Please try again.`);
    }

    return false;
});