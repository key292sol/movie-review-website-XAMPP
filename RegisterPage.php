<style type="text/css">
	fieldset div{
		padding-bottom: 6px;
	}

	fieldset{
		border-color: #c3e0d2;
	}
</style>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="./Images/favicon.png">
</head>


<?php

if(isset($_POST["username"])){
	include './Database/UserAndLoginDB.php';

	$username = $conn->real_escape_string($_POST["username"]);

	$fname = $conn->real_escape_string($_POST["fname"]);
	$lname = $conn->real_escape_string($_POST["lname"]);
	$email = $conn->real_escape_string($_POST["useremail"]);
	$phone = $conn->real_escape_string($_POST["userphone"]);

	echo "<script>";
	if ($username == "[deleted]") {
		echo 'alert("You can\'t use that username")';
	} elseif(DoesUsernameExist($username)){
		echo 'alert("Username already exists")';
	}
	else{
		$password = $_POST["userpass"];

		// Select a random file for the user Avatar
		$files = glob('./Avatars/*.png');
		$img_file = array_rand($files);
		$avatar_addr = $files[$img_file];

		AddAccount($username, $password, $fname, $lname, $email, $avatar_addr, $phone);

		$dirname = "./User Accounts/".$username;
		if (file_exists($dirname)) {
			echo 'alert("File already exists")';
		} else {
			mkdir($dirname);
			$fcreate = fopen($dirname."/lists.txt", "w");
			fclose($fcreate);
		}

		SetCookies($username);
		GotoHomePage();
	}

	echo '</script>';

} else {
	$fname = "";
	$lname = "";
	$email = "";
	$phone = "";
}

?>

<body>	
	<link rel="stylesheet" type="text/css" href="./CSS/RegisterPageStyle.css">
	<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">

	<div class="content">
		<div class="headdiv">
			<p class="headpara"> Register</p>
		</div>
		<br>
		<form name="registerform" method="post" action="" onsubmit="return submitClicked()">
			<div class="bigformclass">
				<fieldset>
					<legend> Name </legend>
					<div>
						<input type="text" name="fname" placeholder="First Name" value="<?php echo $fname ?>" autofocus required>
						<br><br>
						<input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname ?>" required>
					</div>
				</fieldset>
				<br>

				<fieldset>
					<legend> Contact </legend>
					<div>
						<input type="email" name="useremail" placeholder="Email" value="<?php echo $email ?>" pattern="[a-zA-Z0-9._]+@[A-Za-z0-9]+\.[a-zA-Z]{2,4}$" required>
						<br><br>
						<input type="tel" name="userphone" placeholder="Phone Number" value="<?php echo $phone ?>" pattern="[0-9]{10}$">
					</div>
				</fieldset>
				<br>

				<fieldset>
					<legend> Account details </legend>
					<div>
						<input type="text" id="username" name="username" placeholder="Username" required>
						<div id="usernameerror"></div>
						<br>
						<input id="userpass" name="userpass" type="password" placeholder="Password" required>
						<br><br>
						<input id="pass2" type="password" placeholder="Confirm Password" required>
					</div>	
				</fieldset>
				<br>
			</div>

			<div>
				<input type="checkbox" id="check" name="acceptcheck" required>
				<label for="acceptcheck"> All the details that i have entered are correct </label>
			</div>
			<br>

			<center> 
				<input type="submit" value="Submit" class="submitbutton">
			</center>
		</form>

		<div>
			<center>
				<p style="color: #fefefe;">
					Already have an account?
					<a href="LoginPage.php"> Log In</a> 
				</p>
			</center>
		</div>
	</div>


	<script type="text/javascript">

		function submitClicked(){
			if (document.getElementById('username').value.includes(" ")) {
				alert("Username cannot contain spaces");
				return false;
			}

			var pass1=document.getElementById("userpass").value;
			var pass2=document.getElementById("pass2").value;

			if(pass1 == pass2){
				return true;
			}
			else{
				alert("Both of the passwords do not match");
				return false;
			}
		}
	</script>
</body>