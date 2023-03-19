<link rel="stylesheet" type="text/css" href="./CSS/RegisterPageStyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/LoginPageStyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="./Images/favicon.png">
</head>

<?php
	include './Database/UserAndLoginDB.php';
?>

<style type="text/css">
	img{
		position: absolute;
		width: 90px;
		height: 90px;
		border-radius: 50%;	
		top: -45px;
		left: calc(50% - 45px);
	}
</style>

<body>

<div class="content">
	<center>
		<p> Login </p>
	</center>

	<form method="post">
		<input type="text" name="username" placeholder="Username" autofocus required>
		<div id="errdiv"></div>
		<input type="password" name="password" placeholder="Password" required>
		<br>
		<input type="submit" class="submitbutton" value="Log In">
	</form>
	<button class="forgotpassbutton" onclick="window.location.href='ForgotPasswordMail.php'"> Forgot password? </button>
	<button class="signinbutton" onclick="window.location.href='RegisterPage.php'"> Sign In </button>
</div>

</body>

<?php

if(isset($_POST["username"])){
	$username = $conn->real_escape_string($_POST["username"]);
	$password = $conn->real_escape_string($_POST["password"]);

	echo "<script>";
	if(LoginFunc($username, $password)){
		SetCookies($username);
		GotoHomePage();
	}else{
		echo '
			document.getElementById("errdiv").innerHTML = "Username or Password is not correct";
		';
	}
	echo "</script>";
}

?>