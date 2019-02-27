/* 
This javascript files handles:
    - Each post type data collection
    - Submission of data to server via ajax 
    - Adds the post content to the wall
*/

/* Handle text post */

$("#comment-post").click(function () { // if the comment menu option type is selected

    $('#txtPost').toggleClass('active'); // toggle add/remove class when button is clicked
    $('#imgPost').removeClass('active'); // if another menu option is open remove the class to close the option
    $('#mapPost').removeClass('active'); // if another menu option is open remove the class to close the option

    $('#saveTextBtn').click(function () { // when save button is clicked
    
        let to = sessionStorage.getItem('wallID'); // get the wall owners user id - this value is set in the BlockReportUser.js file
        let fromId = parseInt($(".user").attr('id'));
        let origin = $(".country").attr('id');
        let postDate = new Date().toISOString().split("T")[0]; // Get date and convert to string suitable for MySQL DB [Ref. https://stackoverflow.com/questions/2280104/convert-javascript-to-date-object-to-mysql-date-format-yyyy-mm-dd]
        let message = $('#txtComment').val(); // Get comment message

        saveTextData(message, to, fromId, origin, postDate);
        
    });

    return; // exit function
});

function saveTextData(post, to, fromId, origin, date) { // post by will come from $_SESSION['user_id'] value in DAO

    $.ajax({
        type: "POST",
        url: "WallPostsDAO.php",
        data: {
            to: to,
            from: fromId,
            origin: origin,
            contents: post,
            date: date
        },
        success: function (response) {
            if(response === "true") {
                console.log("Successfully saved post data");
                location.reload(); 
            } else {
                alert("Your post was not saved.");
            }
        }
    });


    return false; // exit function
}


// Image Posts
$("#image-post").click(function () {

    $('#imgPost').toggleClass('active'); // toggle add/remove class when button is clicked
    $('#txtPost').removeClass('active'); // if another menu option is open remove the class to close the option
    $('#mapPost').removeClass('active'); // if another menu option is open remove the class to close the option

    $('#fileInput').change(function (event) {
        var file = event.target.files[0]; // get selected file [0] as only one file is ever required
        var reader = new FileReader(); // handle loading of image and attaching to img src

        reader.onloadend = function () {
            $('#fileImagePreview').attr('src', reader.result) // give img tag the image to display
        }

        if (file) {
            reader.readAsDataURL(file); // read the blob and display preview
        } else {
            $('#fileImagePreview').attr('src', ""); // empty tag and no image is displayed
        }
    });

     $('#saveImgBtn').click(function () { // when save button is clicked
         let to = sessionStorage.getItem('wallID'); // get the wall owners user id - this value is set in the BlockReportUser.js file
         let fromId = parseInt($(".user").attr('id'));
         let origin = $(".country").attr('id');
         let postDate = new Date().toISOString().split("T")[0]; // Get date and convert to string suitable for MySQL DB [Ref. https://stackoverflow.com/questions/2280104/convert-javascript-to-date-object-to-mysql-date-format-yyyy-mm-dd]
         let image = $('#fileInput')[0].files[0];
         let img_url = window.URL.createObjectURL(image);
         let html = $(`<div class="post h4 v4"> <img src="${img_url}"> <br><br> ${postDate} </div>`).fadeIn(500, function () {
             // document.post.reset();
         });
         $(".wall").prepend(html);
         console.log(`Image: ${image} and Image URL: ${img_url}`);
         // saveImageData(message);
        // saveImageData(message);
         
     });
});

function saveImageData(post, to, fromId, origin, date) { // post by will come from $_SESSION['user_id'] value in DAO

    $.ajax({
        type: "POST",
        url: "WallPostsDAO.php",
        data: {
            to: to,
            from: fromId,
            origin: origin,
            contents: post,
            date: date
        },
        success: function (response) {
            if (response === "true") {
                console.log("Successfully saved post data");
                location.reload();
            } else {
                alert("Your post was not saved.");
            }
        }
    });


    return false; // exit function
}

// map location posts not working fully 
$("#loc-post").click(function(){
    $('#mapPost').toggleClass('active'); // toggle add/remove class when button is clicked
    $('#txtPost').removeClass('active'); // if another menu option is open remove the class to close the option
    $('#imgPost').removeClass('active'); // if another menu option is open remove the class to close the option

    $('#saveTextBtn').click(function () { // when save button is clicked

        let to = localStorage.getItem('wallOwnerID');
        let postDate = new Date().toDateString();
        let lat = lat;
        let long = long;
      
        let html = $(`<div class="post h4 v3"> ${message} <br><br> ${postDate} </div>`).fadeIn(500, function () {
            //document.post.reset(); 
        });
        $(".wall").prepend(html);
        // saveTextData(message, to, postDate, html);

    });

    return; // exit function
});

function saveMapData(post, to, date, html) { // post by will come from $_SESSION['user_id'] value in DAO

    $.ajax({
        type: "POST",
        url: WallPostsDAO.php,
        data: "long=" + long + "&lat=" + lat + "&to=" + to + "&date=" + date,
        success: function () {
            $(".wall").prepend(html);
        }
    });


    return false; // exit function
}
