<head>
	<link rel="shortcut icon" type="image/x-icon" href="./Images/favicon.png">
</head>

<?php
	include './Database/UserAndLoginDB.php';
	$user_id = $conn->real_escape_string($_POST["userid"]);
	echo '
		<body style="background-color: #222222; color: #ffffff;">
	';
	if(!isset($_POST["password"])){
		echo '
			<link rel="stylesheet" type="text/css" href="./CSS/LoginPageStyle.css">
			<link rel="stylesheet" type="text/css" href="./CSS/RegisterPageStyle.css">
		<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">
			<style>
				input{
					width: 280px;
					height: 30px;
				}

				input[type=password]{
					outline: none;
					background: transparent;
					border: none;
					border-bottom: 1px solid white;
					font-size: 12pt;
				}

				input[type=submit]{
					width: 100px;
					margin-top: 10px;
					margin-bottom: 0px;
				}
			</style>

			<div class="content">
				<form method="post">
					<label for="password" style="color: #fefefe; font-size: 14pt;"> Enter the new password for @'.GetUserLoginUserById($user_id).' </label>
					<br><br>
					<input type="password" name="password" placeholder="New Password" required>
					<br><br>
					<input type="hidden" name="userid" value="'.$user_id.'">
					<center>
						<input type="submit" class="submitbutton" value="Change">
					</center>
				</form>
			</div>
			</body>
		';
	}
	else{
		//Update password in the database
		$pass = $conn->real_escape_string($_POST["password"]);

		if(UpdatePassword($user_id, $pass)){
			echo "Password updated";	
		}
		else{
			echo "There was in error in updating password";
		}
		echo "<br>";
		echo '<button onclick="window.location.href = \'LoginPage.php\'"> Log In </button>';
	}
?>