/* ********************************************************************** */
/*  Settings.js handles:                                                  */
/*  - submission of account deactivation to php script via ajax request   */                                
/* ********************************************************************** */

//Event handler for each "Delete User" action
$('#deactivateBtn').click(function () { // when clicked

    // prompt user to type delete to confirm user account should be deleted.
    let confirmDeactivate = prompt("Please type the word 'deactivate' to deactivate your account. \nWarning: You will need to contact support to reactivate.");

    if (confirmDeactivate == 'deactivate') { // check that the word delete was typed correctly.

        //console.log(userID);
        $.ajax({
            type: "POST",
            url: "SettingsDAO.php",
            data: {
                aid: "deactivate"
            }
        }).done(function (response) {
            if (response == "success") {
               let deactivateSuccess = alert("You will now be logged out.");
               location.href="/";
            } else {
                alert(`Something went wrong. Please try again or contact support.`);
            }
        });

    } else {
        // inform admin that the process was cancelled and then exit the function
        alert(`Your account was not deactivated.`);
    }

    return false;
});