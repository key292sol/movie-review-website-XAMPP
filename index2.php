<link rel="stylesheet" type="text/css" href="./CSS/indexstyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">

<script type="text/javascript">
	function submit_index() {
		document.getElementsByTagName('form')[0].submit();
	}

<?php
if (isset($_GET["guest"])) {
	setcookie("username", " ");
	echo "window.location.href='HomePage.php'";
}
?>

</script>

<div class="centerhead">
	<center>
		<h1>Welcome</h1>
		<h2>Choose your Log In option</h2>
	</center>
</div>

<form>
	<input type="hidden" name="guest">
</form>

<div class="centerdiv">
	<div class="formholder">
		<form>
			<input type="hidden" name="joinmethod">
		</form>
		<center>
			<div>
				<button onclick="window.location.href='LoginPage.php'">Log in</button>	
			</div>
			<br><br>				

			<div>
				<button onclick="window.location.href='RegisterPage.php'">Register</button> 
			</div>
			<br><br>				

			<div>
				<button onclick="submit_index()">No Login</button> 
			</div>
			<br><br>				

		</center>
	</div>
</div>
