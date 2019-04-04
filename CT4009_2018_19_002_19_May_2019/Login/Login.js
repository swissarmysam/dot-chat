/* ******************************************************************************************************* */
/* * LoginDAO.php handles user and administrator logins:                                                 * */
/* * - It sanitizes the submission and checks that a record exists in tbl_member                         * */
/* * - It checks that the acc_active value is set to 1                                                   * */
/* * - Check that the user is not banned                                                                 * */
/* ******************************************************************************************************* */

function loginUser(){
	
	let email = $("#txtEmail").val();
	let password = $("#txtPw").val();
	
	// check if either input field is empty and stop submission if true
	if($("#txtEmail").val() == "" || $("txtPw").val() == "") {

		alert("Please enter the email address and/or password used to sign up"); // alert user if field is empty

	} else {
	
		$.ajax({
			type: "POST",
			url: "LoginDAO.php",
			data: {
				loginUser: "loginUser",
				email: email,
				password: password
			},
			success: function (response) {

				if(response=="success") {
					window.location.href = "User/BlockReportUser/BlockReportUser.php";
				} else {
					$('div#warning').innerHTML("Email/Password combination was incorrect");
				}
			}
		});	
	}
	return false;
};