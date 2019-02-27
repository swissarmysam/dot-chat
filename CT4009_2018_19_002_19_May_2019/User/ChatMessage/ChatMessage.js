/* 
This javascript files handles:
    - Handle message data
    - Submission of data to server via ajax 
    - Adds the message content to the page
*/

/* Handle text post */

$("#send_msg").click(function () { // if the comment menu option type is selected


    let to = sessionStorage.getItem('chatID'); // get the chat to user id - this value is set in the BlockReportUser.js file
    let from = parseInt($(".user").attr('id'));
    let message = $('#msg_contents').val(); // Get message

    // console.log("contents", message);

    saveMsgData(message, to, from);


    return; // exit function
});

function saveMsgData(message, to, from) { // post by will come from $_SESSION['user_id'] value in DAO

    $.ajax({
        type: "POST",
        url: "ChatMessageDAO.php",
        data: {
            to: to,
            from: from,
            message: message
        },
        success: function (response) {
            if (response === "true") {
                console.log("Successfully saved message data");
                location.reload();
            } else {
                alert("Oops. Your message didn't send. Please try again.");
            }
        }
    });


    return false; // exit function
}

