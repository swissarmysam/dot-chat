/* This script handles the validation of inputs on the registration form and makes an ajax request to the server to handle user registration */

/* PASSWORD VALIDATION AND COMPLEXITY CHECKS */

// Select password elements from register page 
const PW = document.querySelector('input[name="enter_password"]'); // select first password input field
const CONFIRM_PW = document.querySelector('input[name="confirm_password"]'); // select confirm password input field
const METER = document.querySelector('#pw-complexity'); // select password colour strength meter
const STRENGTH_TEXT = document.querySelector('#pw-strength'); // select password text feedback

/* The following code checks password complexity using ZXCVBN */

// text feedback object to compare against value returned by ZXCVBN function
const STRENGTH = {
    0: "Bad",
    1: "Weak",
    2: "Okay",
    3: "Good",
    4: "Strong"
}

PW.addEventListener('input', function () { // check password field input 
    let pwValue = PW.value; // get password value from input
    let result = zxcvbn(pwValue); // pass the password to zxcvbn library to check complexity
    // console.log(METER.value);

    METER.value = result.score; // use the resulting score given back by zxcvbn (whole number) to style the meter according to css

    if (pwValue !== " ") { // if a password has been entered then provide textual feedback selected from object above
        STRENGTH_TEXT.innerHTML = STRENGTH[result.score];
    }
});

/* The following code validates that the passwords match before submission */

function checkPasswordMatch() {
    if (PW.value !== CONFIRM_PW.value) { // if passwords field input value does not match
        CONFIRM_PW.setCustomValidity("Passwords do not match"); // display do not match message
    } else { 
        CONFIRM_PW.setCustomValidity(" "); // no message is displayed
    }
}

PW.addEventListener('change', checkPasswordMatch); // if change detected on input PW input field then call function
CONFIRM_PW.addEventListener('keyup', checkPasswordMatch); // check confirm password field value

/* PASSWORD CODE ENDS */

/* FORM SUBMISSION HANDLING CODE */
function validateInputFields(form) { // pass submitted form as an argument so it can be validated
    let full_name = $("#full_name").val(); // get user input full name
    let email = $("#user_email").val(); // get user input email address
    let password = $("#confirm_password").val(); // get user input password from confirm password field
    let country = $("#country").children("option:selected").val(); // get user selected country from select/option tag - option is a child of select tag and need to get selected value

    let data = 'full_name=' + full_name + "&email=" + email + "&password=" + password + "&country=" + country; // build url which will be sent as POST request
    
    let empty = 0; // empty flag for input validation
    // check each input field with .field-text class and check if any value is input
    // if not then enter an error message into the #warning div
    
    $.each($(".field-text"), function (idx, val) { // iterate through each input field
        if (val.value.length == 0) { // check if field is empty
            $('#warning').html("Please complete all fields").css('color', 'red'); // add red warning text with user instruction to warning div
            empty = 1; // change flag value to stop submitDetails being invoked
        }
    });
    if (!empty) { // if empty flag is 0
        // if all fields have been completed then continue to submit the form
        if(password.length < 8) { // if password length is more than 8 characters
            PW.setCustomValidity("Password must be at least 8 characters");
            return false;
        } else {
            PW.setCustomValidity(" ");
            submitDetails(data);
        }
    }
}


// create function to which submit details and creates database entry
function submitDetails(dataString) { // the url built in validateInputFields is passed as an argument
 
    if (!$("#acceptConditions")[0].checked) { // check that T&C checkbox is ticked
        alert("Please accept the Terms & Conditions"); // Advise user to check that T&C checkbox is ticked
        return false; // exit function
    } else {
        $.ajax({ // send ajax request to server to handle user submission
            type: "POST", // send as POST method as it includes private information
            url: "RegisterDAO.php", // send to form to RegisterDAO as action
            data: dataString, // data contents is the URL built and passed as an argument
            cache: false, // stop browser caching requested page 
            success: function () { // if request is successful run the function
                alert("Account succesfully created. Redirecting to login."); // advise user that account has been created then ...
                window.location.href = "../index.php"; // redeirect the user to login
            }
        });
    }
};

/* FORM HANDLING ENDS */