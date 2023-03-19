<head>
	<link rel="shortcut icon" type="image/x-icon" href="./Images/favicon.png">
</head>

<?php

function BeforeSendingEmail($username_error = "")
{
	echo '
<!DOCTYPE HTML>

<body>
	<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">
	<style type="text/css">
		body{
			background-color: #222222;
			color: #fefefe;
		}

		label{
			font-size: 14pt;
			color: #50bcec;
		}
			
		input[type=text]{
			font-size: 12pt;
			width: 280px;
			color: #fefefe;
			outline: none;
			background: transparent;
			border: none;
			border-bottom: 1px solid #ffffff;
			padding: 5px;
			margin: 5px 0;
		}

		input[type=submit]{
			width: 100px;
			height: 35px;
			color: #000000;
			margin-top: 2em;
		}

		.centerdiv{
			max-width: 300px;
			position: absolute;
			top:50%;
			left:50%;
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			background-color: #000000;
			padding: 40px;
		}

		.headp{
			color: #50bcec;
			font-size: 16pt;
			padding-bottom: 15px;
		}

		.centerdiv{
			padding-top: 1em;
		}

	</style>


	<div class="centerdiv">
		<center>
		<p class="headp">
			Enter your Username and Email-ID to send a link to change password
		</p>
		</center>
		<form action="ForgotPasswordMail.php" method="post">
			<label for="username"> Enter your username</label>
			<input type="text" name="username" placeholder="Username" required>
			<br>
			'.$username_error.'
			<br>
			<center>
			<input type="submit" value="Send Email">
			</center>				
		</form>
	</div>
</body>

	';
}

?>

<?php
	if(isset($_POST["username"])){
		include './Database/UserAndLoginDB.php';
		$username = $conn->real_escape_string($_POST["username"]);
		if (DoesUsernameExist($username)) {
			$user = GetDetails($username);
			$to = $user["email_id"];
			$url = $_SERVER['REQUEST_URI'];
			$chk_for = "/ForgotPasswordMail.php";
			$index = strpos($url, $chk_for);

			$sub = 'Password change request';
			$msg = '<html><body>
						<p>Click on the following button to change your password. <p>
						<form action="localhost/'.substr($url, 0, $index).'/ForgotPassword.php" method="post">
							<input type="hidden" name="userid" value="'.$user['id'].'">
							<input type="text" value="'.$username.'" disabled>
							<input type="submit" value="Change Password">
						</form>
					</body></html>';

			$headers = "Content-type:text/html;charset=UTF-8"."\r\n";

			echo'
				<style>
					body{
						background-color: #222222;
						color: #fefefe;
					}
				</style>
			';
			
			if(mail($to, $sub, $msg, $headers)){
				echo "An email has been sent to $to <br>
						Please check your mail";
			}
			else{
				BeforeSendingEmail("There was a problem in sending email to $to");
			}
		} else {
			BeforeSendingEmail("The username you entered does not exist");
		}

	}
	else{
		BeforeSendingEmail();
	}
?>
