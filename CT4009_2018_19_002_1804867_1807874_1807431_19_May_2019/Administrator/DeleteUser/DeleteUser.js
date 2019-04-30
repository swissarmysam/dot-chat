// The code below handles the javascript 
// for deleting user accounts from the database


//Event handler for each "Delete User" action
$('.actionDeleteUser').click(function () { // when clicked
    let row = $(this);
    let username = $(this).closest('td').siblings('.user_name').text(); // get text contents of td (username) 
    let deleteID = parseInt($(this).closest('td').attr('id')); // get user key ID and immediately convert to integer
    // console.log(userID);

    // prompt user to type delete to confirm user account should be deleted.
    let confirmDelete = prompt("Please type the word 'delete' to confirm user deletion. \nWarning: Deleting an account is permanent and cannot be undone.");

    if (confirmDelete == 'delete') { // check that the word delete was typed correctly.

        //console.log(userID);
        $.ajax({
            type: "POST",
            url: "DeleteUserDAO.php",
            data: {id: deleteID}
        }).done(function(response){
            if(response == 1){
                alert(`${username} successfully deleted`);
                row.closest('tr').css('background', 'red');
                row.closest('tr').fadeOut(750, function(){
                    $(this).remove();
                })
            } else {
                alert(`An error occurred and ${username} has not been deleted. Please try again.`);
            }
        });
        
    } else {
        // inform admin that the process was cancelled and then exit the function
        alert(`The delete process was stopped. Please try again.`);
    }

    return false;
});