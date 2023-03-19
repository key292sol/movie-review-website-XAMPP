<head>
	<link rel="shortcut icon" type="image/x-icon" href="./Images/favicon.png">
</head>

<link rel="stylesheet" type="text/css" href="./CSS/headerstyle.css">

<header>
<div class="header">
	<div class="my-logo">
		<img src="./Images/logo.png">
	</div>
	<div>

<?php

$but_info = array(
				"HOME" => "window.location.href='index.php'", 
				"GENRES" => "window.location.href='Movie_Group.php'",
				"WATCH LIST" => "SubmitHeaderListForm('watch')",
				"COMPLETED" => "SubmitHeaderListForm('completed')"
			);

foreach ($but_info as $name => $link) {
	echo "<button class=\"headerbutton\" onclick=\"$link\">  $name </button>";
}


?>
		
		<form id="list-form" action="Movie_Group.php" style="display: none;">
			<input type="hidden" name="list" id="list-form-list">
		</form>

		<form class="searcher" action="Movie_Group.php">
			<input type="text" name="search-movie" placeholder="Search Movie Name" required>
			<input type="submit" value="Search">
		</form>
	</div>
</div>

<script type="text/javascript">
	function SubmitHeaderListForm(val) {
		document.getElementById('list-form-list').value = val;
		document.getElementById('list-form').submit();
	}
</script>

</header>