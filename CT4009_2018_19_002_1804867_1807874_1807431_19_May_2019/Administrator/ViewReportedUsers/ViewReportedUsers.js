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
    let reportId = parseInt($(this).closest('td').attr('id'));
    sessionStorage.setItem('checkReportId', reportId);
});

$(".close").on("click", function () { // when the close button is clicked
    modal.css("display", "none"); // make the modal invisible
});

// 

$('#SubmitBtn').on("click", getReport);

function getReport(){

    let action = $('input[name=action]:checked').val(); // get the value from the radio input
    let user = sessionStorage.getItem('checkReportId'); // get the user id so user can be found in members database


    switch(action) {

        case "warning":
            sendReport(user, "warning");
            break;

        case "one-day":
            sendReport(user, "one-day");
            break;

        case "three-day":
            sendReport(user, "three-day");
            break;

        case "ban-forever":
            sendReport(user, "ban-forever");
            break;

        case "delete-report":
            sendReport(user, "delete-report");
            break;

        default:
            alert("No action has been taken.");
            return false;
    }
}

function sendReport(user = 0, action) { // build request to server from user id and action for server -> handleReport() in DAO

    $.ajax({
        type: "POST",
        url: "ViewReportedUsersDAO.php",
        data: {
            uid: user,
            action: action
        },
        cache: false,
        success: function() {
            alert("Report action successful");
            location.reload(true);
        }
    }); // 

}