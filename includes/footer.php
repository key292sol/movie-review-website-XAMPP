<link rel="stylesheet" type="text/css" href="./CSS/FooterStyle.css">

<script type="text/javascript">
	var body = document.getElementsByClassName('body')[0];
	var sidebar = document.getElementsByClassName('sideblock')[0];
	body.style.minHeight = sidebar.clientHeight;
</script>

<footer>
	<div class="footer-body">
		<div class="about-us">
			Get the reviews of various movies. <br>
			Create a Watch List so that you can keep track of the movies you want to watch.<br>
			Your future self won't have to worry about forgetting what you want to watch today because they can just look in the watch list to check it.
		</div>
		<div class="social-media">
			You can contact and follow us on various social media platforms
			<ul>
				<li><a href="https://instagram.com" target="_blank"> Instagram </a></li>
				<li><a href="https://facebook.com" target="_blank"> Facebook </a></li>
				<li><a href="https://www.linkedin.com" target="_blank"> LinkedIn </a></li>
			</ul>
		</div>
		<div class="goto-top">
			<a href="#top"><strong>&#8593;</strong></a>
		</div>
		<div class="pages">
			Link to all the pages:
			<ul>
				<li> <a href="index.php"> Home </a></li>
				<li> <a href="Movie_Group.php"> Genres </a></li>
				<li> <a href="javascript: SubmitHeaderListForm('watch')"> Watch List </a></li>
				<li> <a href="javascript: SubmitHeaderListForm('completed')"> Completed List </a></li>
			</ul>
			<form class="footer-searcher" action="Movie_Group.php">
				<input type="text" name="search-movie" placeholder="Search Movie Name" required>
				<input type="submit" value="Search">
			</form>
		</div>
	</div>
</footer>