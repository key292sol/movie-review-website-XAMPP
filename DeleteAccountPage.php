<link rel="stylesheet" type="text/css" href="./CSS/RegisterPageStyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/LoginPageStyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="./Images/favicon.png">
</head>


<div class="content">
	<center>
		<p style="margin-bottom: 1em;"> Delete  Account </p>
	</center>

	<form method="post">
		<input type="password" name="password" placeholder="Enter Password" required>
		<div id="errdiv" style="height: 0.2em;"></div>
		<input type="submit" class="submitbutton" style="width: 100%;" value="Log In">
	</form>
	<button class="forgotpassbutton" onclick="window.location.href='ForgotPasswordConfirm.html'"> Forgot password? </button>
	<button class="signinbutton" onclick="window.location.href='index.php'"> Home </button>
</div>

<?php

if (isset($_POST["password"])) {
	include './Database/UserAndLoginDB.php';

	echo "<script>";
	if (LoginFunc($conn->real_escape_string($_COOKIE["username"]), $conn->real_escape_string($_POST["password"]))) {
		DeleteAccount($conn->real_escape_string($_COOKIE["username"]));
		echo "alert('Your account has been deleted');";
		RemoveCookies();
	} else {
		echo "document.getElementById('errdiv').innerHTML = 'Incorrect Password'";
	}
	echo "</script>";
}

?>