<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">


<?php
include './includes/all_includes.php';
include './includes/MovieBlocks.php';
function GotoLogin()
{
	echo '<script> window.location.href = "LoginPage.php"; </script>';
}

$header = -1;
?>

<style type="text/css">
	.body{
		padding: 0;
		width: 85%;
	}
</style>
<div class="body">

<?php
if (isset($_GET["genre"])) {
	include "./Database/MoviesDB.php";

	StartGrid("Search Results", "movie", "MovieInfoPage.php");

	$res = SearchMovie("genres", $_GET["genre"]);
	foreach ($res as $movie) {
		AddOneDiv($movie["poster"], $movie["movie_name"], $movie["id"]);
	}
	
}
elseif (isset($_GET["list"])) {

	if (!isset($_COOKIE["username"])) 	{ GotoLogin(); }
	if ($_COOKIE["username"] == " ")	{ GotoLogin(); }

	include "./Database/MoviesDB.php";

	if 		($_GET["list"] == "watch") 		{ $header = 2; }
	elseif 	($_GET["list"] == "completed") 	{ $header = 3; }

	// ucfirst(str) converts the first character to uppercase
	StartGrid(ucfirst($_GET["list"])." List", "movie", "MovieInfoPage.php");
	ListDisplay($_GET["list"][0]);
	
}
elseif (isset($_GET["search-movie"])) {
	include "./Database/MoviesDB.php";

	StartGrid("Search Results", "movie", "MovieInfoPage.php");

	$res = SearchMovie("movie_name", $_GET["search-movie"]);
	foreach ($res as $movie) {
		AddOneDiv($movie["poster"], $movie["movie_name"], $movie["id"]);
	}
	
}
else{
	$header = 1;
	include './includes/Movie_Categories.php';
	include "./Database/MoviesDB.php";

	StartGrid("All Genres", "genre", "");

	$view = GetMovieGenres();
	foreach ($view as $genre) { 
		$poster = SearchMovie("genres", $genre)->fetch_assoc()['poster'];
		AddOneDiv($poster, $genre, $genre);
	}

}

EndGrid();

if ($header != -1) {
	echo'
		<script>
			document.getElementsByClassName("headerbutton")['.$header.'].style.borderBottom = "3px solid red";
		</script>
	';
}

?>
</div>


<?php
include './includes/footer.php';
?>