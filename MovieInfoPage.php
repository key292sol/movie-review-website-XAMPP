<link rel="stylesheet" type="text/css" href="./CSS/MovieInfoPage.css">
<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">

<?php
function MovieNotFound()
{
	echo "<script>
			window.location.href = 'MovieNotFoundPage.php';
		  </script>
		 ";
}

function GotoLogin()
{
	echo '<script> window.location.href = "LoginPage.php"; </script>';
}

if (!isset($_GET["movie"])) { MovieNotFound(); }

include "./includes/all_includes.php";
include_once './Database/MoviesDB.php';
include './Database/ReviewsDB.php';

$movie_id = $conn->real_escape_string($_GET["movie"]);
$new_line = "
";

$movie_info = GetMovieById($movie_id);
if (!$movie_info) { MovieNotFound(); }

if (DoReviewsExists($movie_id)) {
	$avg_rate = GetAverageRating($movie_id);
	$user_rate = round($avg_rate->fetch_assoc()["AVG(rev_rating)"],1)."/10";	
} else {
	$user_rate = "N/A";
}


// Check if user has posted a review
if (isset($_POST["review"])) {
	if (isset($_COOKIE["username"])){
		InsertReview($movie_info["id"], 
					$conn->real_escape_string($_POST["review"]), 
					$conn->real_escape_string($_POST["rev-rate"]), 
					$_COOKIE["username"], $_COOKIE["avatar"]);
	} else {
		GotoLogin();
	}
}

// Check if user has deleted a review
if (isset($_POST["delete-rev"])) {
	DeleteReview($conn->real_escape_string($_POST["delete-rev"]));
}

$res = GetMovieReviews($movie_info["id"]);

// Check if user has added the movie to a list or not
if (isset($_POST["setlist"])) {
	if (isset($_COOKIE["username"])) {
		if ($_COOKIE["username"] != " "){
			SetTheList($_COOKIE["file_path"], $conn->real_escape_string($_POST["setlist"]), $movie_id);
		}
		else{
			GotoLogin();
		}
	}
	else{
		GotoLogin();
	}
}

// The signs on the watch lists and completed buttons
// "&#10003" is the unicode for tick mark
$w_sign = "+";
$c_sign = "+";
if (isset($_COOKIE["file_path"])) {
	if ($_COOKIE["file_path"] != " "){
		$user_file = file($_COOKIE["file_path"]);
		foreach ($user_file as $file_line) {
			if (substr($file_line, 4) == $movie_id.$new_line) {
				if 		($file_line[0] == "w")	{ $w_sign = "&#10003"; }
				elseif  ($file_line[0] == "c") 	{ $c_sign = "&#10003"; }
				break;
			}
		}
	}
}

?>

<form id="setlist-form" method="post" style="display: none;"> 
	<input type="hidden" name="setlist" id="setlist"> 
</form>

<div class="body">
	
	<center>
		<h1> <?php echo $movie_info["movie_name"] ?></h1>
	</center>

	<div class="trailerandposter">
		<video controls poster="<?php echo $movie_info["vid_poster"] ?>">
			<source src="<?php echo $movie_info["trailer_address"] ?>" type="video/mp4" >
			Couldn't Load Video
		</video>    

		<img src="<?php echo $movie_info["poster"] ?>">
	</div>
	<br>

	<div class="movie-infos">
		<div class="movie-info-1"> 
			<?php

				$array = array(
								"Genre"=>"genres",
								"Cast" => "cast",
								"Director" => "director",
								"Age Rating" => "age_rating"
								// "Available for streaming" => "streaming"
							);

				foreach ($array as $title => $dbcol) {
					echo ' <b> '.$title.':</b> '.$movie_info[$dbcol]."<br>";
				}

			?>
		</div>

		<div class="movie-info-2">
			<?php
				$array = array(
								"IMDB Rating" => "rating",
								"Release Date" => "release_date",
								"Duration" => "duration",
							);

				$extra_text = array(
								"IMDB Rating"=>"/10",
								"Duration"=>" min"
							);

				foreach ($array as $title => $dbcol) {
					echo ' <b> '.$title.':</b> ';
					if ($dbcol == "release_date") {
						echo date("d/m/Y", strtotime($movie_info[$dbcol]));
					}else{
						echo $movie_info[$dbcol];
					}

					if (isset($extra_text[$title])) {
						echo $extra_text[$title];
					}
					echo "<br>";
				}

			?>
			<b>User Rating: </b> <?php echo $user_rate ?>
		</div>
	</div>

	<div class="list-buttons-div">
		<center>
			<button class="list-button" onclick="SubmitListForm('w')"> <?php echo $w_sign; ?> Watch Later </button>
			<button class="list-button" onclick="SubmitListForm('c')"> <?php echo $c_sign; ?> Completed </button>
		</center>		
	</div>

	<div class="movie-desc">
		<h2> Plot Summary </h2>
		<p>
			<?php echo $movie_info["plot"]; ?>
		</p>
	</div>

	<script type="text/javascript">
		function SubmitListForm(val) {
			document.getElementById('setlist').value = val;
			document.getElementById('setlist-form').submit();
		}
	</script>

	<div class="for-reviews">
		<h2>Reviews of People</h2>
		<?php
			include 'Reviews.php';
		?>    	
	</div>
</div>



<?php
include './includes/footer.php';
?>