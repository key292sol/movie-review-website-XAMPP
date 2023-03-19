<link rel="stylesheet" type="text/css" href="./CSS/HomePage.css">
<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">

<?php
include './includes/all_includes.php';

$home_sections = array("Trending Movies", "Recently Added");
$dbcols = array("release_date and rating", "added_date");
$limits = array(10, 10);
$c = count($home_sections);

$home_sections_count = count($home_sections);
?>

<script type="text/javascript">
	document.getElementsByClassName('headerbutton')[0].style.borderBottom = "3px solid red";
</script>
<form id="movie-form" action="MovieInfoPage.php" style="display: none;">
	<input type="hidden" id="movie-value" name="movie">
</form>

<div class="body">
	<?php
		include './includes/HomePageSlideShow.php';
		include './includes/MovieBlocks.php';

		for ($i=0; $i < $c; $i++) { 
			$res = GetHomePageValues($dbcols[$i], $limits[$i]);
			echo '
					<div class="section">
						<h1> '.$home_sections[$i].' </h1>
						<div class="flex-container">
							<div class="flex-content">';
							
								foreach ($res as $r) { 
									AddOneDiv($r["poster"], $r["movie_name"], $r["id"]);
								}
							
			echo '
							</div>
						</div>
					</div>
				';
		}
		
	?>

</div>

<?php
include './includes/footer.php';
?>