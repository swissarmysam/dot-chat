/*
This javascript file does the following:
    - Handles the modal box
    - Collects the report data 
    - Sends the report to the server to handle
*/

// Modal Box Code

let modal = $(".modal-container"); // select the modal container

$(".actionManageReport").on("click", function () { // when the actionManageReport link is clicked 
    modal.css("display", "block"); // make the modal visible
});

$(".close").on("click", function () { // when the close button is clicked
    modal.css("display", "none"); // make the modal invisible
});

// 

function getReport(){

    let action = $('input[name=action]:checked').val(); // get the value from the radio input
    let user = parseInt($(this).closest('td').attr('id')); // get the user id so user can be found in members database

    switch(action) {

        case "warning":
        return sendReport(user, "warning");
        break;

        case "one-day":
        return sendReport(user, "one-day");
        break;

        case "three-day":
        return sendReport(user, "three-day");
        break;

        case "ban-forever":
        return sendReport(user, "ban-forever");
        break;

        default:
        alert("No action has been taken.");
        return false;
    }
}

function sendReport(user, action) { // build request to server from user id and action for server -> handleReport() in DAO

    let dataString = 'user_id=' + user + '&action=' + action;

    $.ajax({
        type: "POST",
        url: ViewReportedUsersDAO.php,
        data: dataString,
        cache: false,
        success: function() {
            alert("Report action successful");
            location.reload(true);
        }
    }); // 

}