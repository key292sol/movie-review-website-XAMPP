<link rel="stylesheet" type="text/css" href="./CSS/Movie_Group.css">

<?php

function StartGrid($heading, $input_name, $action_site="MovieInfoPage.php")
{
	echo '
			<h1 class="grid-header">
				'.$heading.'
			</h1>
			<form method="get" action="'.$action_site.'" id="grid-form" style="display: none;">
				<input type="hidden" id="hidden-value" name="'.$input_name.'">
			</form>
			<div class="grid-body">
		';
}


function AddOneDiv($image_src, $bottom_text, $function_value)
{
	echo '
		<div class="one-genre" onclick="submit_value(\''.$function_value.'\')">
			<div class="genre-poster">
				<img src="'.$image_src.'" alt="Couldn\'t Load Image">
			</div>
			<div class="genre-name">
				'.$bottom_text.'
			</div>
		</div>	
	';
}

function EndGrid()
{
	echo "</div> <!-- class grid-body -->
		<script>
			function submit_value(val) {
				document.getElementById('hidden-value').value = val;
				document.getElementById('grid-form').submit();
			}
		</script>
	";
}

function ListDisplay($char){
	$list_file = file($_COOKIE["file_path"]);
	$value_exists = false;

	foreach ($list_file as $l) {
		if ($l[0] == $char) {
			$m = GetMovieById(substr($l,4));
			AddOneDiv($m["poster"], $m["movie_name"], $m["id"]);
			$value_exists = true;
		}
	}

	if (!$value_exists) {
		echo 'There are no movies added to this list. Go to the <a href="index.php"> HOME </a> page or Search a movie to add to this list';
	}
}

?>