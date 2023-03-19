<link rel="stylesheet" type="text/css" href="./CSS/LoginPageStyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/RegisterPageStyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/Feedback.css">
<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">
<head>
	<link rel="shortcut icon" type="image/x-icon" href="./Images/favicon.png">
</head>

<?php

	if (isset($_POST["feedback"])) {
		include './Database/FeedbackTables.php';
		echo "<h1> Thank You For Sending Your Query </h1>";

		if (isset($_POST["movie"])) {
			InsertMovieRequest($conn->real_escape_string($_POST["movie"]), $conn->real_escape_string($_POST["feedback"]));
		}else{
			InsertWebsiteFeedback($conn->real_escape_string($_POST["feedback"]));
		}

	}
	else{

		$req = false;
		$movie_inp ="";
		if($_GET["query"] == "feedback"){
			$placeholder = "Enter your feedback";
		}	
		else{
			$req = true;
			$placeholder = "Enter the details of movie.";
		}

		if ($req) {
			$movie_inp = '<input type="text" name="movie" placeholder="Name of movie" required>';
		}	

		echo '
				<div class="content">
					<form method="post">
						<p> Your feedbacks and movie requests are very important to us for making this website better </p>
						'.$movie_inp.'
						<textarea name="feedback" placeholder="'.$placeholder.'"></textarea>
						<br>
						<input type="submit" class="submitbutton" value="Submit">
					</form>
				</div>
			';
	}

?>