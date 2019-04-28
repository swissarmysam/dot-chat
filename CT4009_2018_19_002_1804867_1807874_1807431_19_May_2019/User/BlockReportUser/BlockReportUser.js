/*

*/

// This function will take the id attribute of the clicked element and return the memeber id as an integer
// the id attribute is setup like keyword_number i.e. chat_54, wall_54 etc etc
function getUserID(item) { // pass the element being clicked as a parameter
    let id = item.id; // get the link id attribute value
    let getID = id.split("_"); // used to split the id into an array using the _ as a separator
    return parseInt(getID[1]); // id will be given as string so immediately convert to integer
}

// This value will update the session ID for the member the signed in user is interacting with
// it will update the $_SESSION['other_id'] variable that can be used to query the MySQL table
// to return only the relevant data. 
// This promise like implementation results in synchronous behaviour so will wait for the result
// before executing the next part of the code
function updateSessionID(id) {
    return $.ajax({
        type: "POST",
        url: "BlockReportUserDAO.php",
        data: {
            other_id: id // key/value pair for php session var
        }
    }).then(function(response){ // 
        if(response == "success") {
            console.log("Other session ID successfully set");

            return true;
        } else {
            console.log("An error occurred.");
        }
    });
}

/* ******************************************** */
/* EVENT HANDLERS AND SESSION STORAGE VARIABLES */
/* ******************************************** */

//Event handler for each "View User Wall" link in the table created.
$('.actionFollowUser').click(function () {
    let item = this; // this is the link being clicked
    let setFollowID = getUserID(item); // get the member id as an integer
    let update = updateSessionID(setFollowID).done(function(status){
        if(status == true){
            
            sessionStorage.setItem('followID', setFollowID); //store user ID value in local storage so that the value can be passed to the wall posts page
            console.log("Redirecting");
            // redirect here

        }
    });
});


//Event handler for each "View User Wall" link in the table created.
$('.actionViewUserWall').click(function () {
    let item = this; // this is the link being clicked
    let setWallID = getUserID(item); // get the member id as an integer
    let update = updateSessionID(setWallID).done(function (status) {
        if (status == true) {

            sessionStorage.setItem('wallID', setWallID); //store user ID value in local storage so that the value can be passed to the wall posts page
            console.log("Redirecting");
            window.location.href = "../CreateViewStackPosts/WallPosts.php"; // Go to User's wall and pass id value to redirected page

        }
    }); 
});

//Event handler for each "Send Message" link in the table created.
$('.actionChatMessage').click(function () {
    let item = this; // this is the link being clicked
    let setChatID = getUserID(item); // get the member id as an integer
    let update = updateSessionID(setChatID).done(function (status) {
        if (status == true) {

            sessionStorage.setItem('chatID', setChatID); //store user ID value in local storage so that the value can be passed to chat message page
            console.log("Redirecting");
            window.location.href = "../ChatMessage/ChatMessage.php"; // Go to chat message page

        }
    });  
});

//Event handler for each "Report User" link in the table created. This was intended to add +1 to number of reports against user object
let modal = $(".modal-container"); // select the modal container

$('.actionReportUser').click(function () {
    let item = this; // this is the link being clicked
    let setReportID = getUserID(item); // get the member id as an integer
    let update = updateSessionID(setReportID).done(function (status) {
        if (status == true) {

            sessionStorage.setItem('reportID', setReportID);
            modal.css("display", "block");
            
        }
    });   
});

$(".close").on("click", function () { // when the close button is clicked
    modal.css("display", "none"); // make the modal invisible
});

function submitReport() {

    let type = $('input[name=report-type]:checked').val(); // get the value from the radio input
    let user = sessionStorage.getItem('reportID'); // get the user id so user can be found in members database

    $.ajax({
        type: "POST",
        url: "SendReportDAO.php",
        data: {
            uid: user,
            type: type
        },
        cache: false,
        success: function () {
            alert("Report action successful");
            console.log(type, user);
            location.reload(true);
        }
    }); //
}

$('#SubmitBtn').on("click", submitReport);