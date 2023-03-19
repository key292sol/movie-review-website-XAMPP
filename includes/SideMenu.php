<link rel="stylesheet" type="text/css" href="CSS/SideMenuStyle.css">

<?php

if (isset($_POST['logout'])) {
	include './includes/LogOutPage.php';
}

function AddDropList($drop_items, $hrefs){
	echo '<div class="content-list" style="display: block;"> 
			<ul>
		'; 

	$c = count($drop_items);
	#enter elements into the list
	for ($i=0; $i < $c; $i++) {
		echo "<li> 
				<a href = \"javascript:".$hrefs[$i]."\"> ".$drop_items[$i]." </a>
			  </li>
		"; 
	}

	echo "</ul></div>";
}

function AddDropDownButton($butt_text, $drop_items, $hrefs){
	//display drop down text and create list for dropdown
	echo '<div class="drop-down-button">
			'.$butt_text.'
		  </div>';
	AddDropList($drop_items, $hrefs);
}

function LoginButton()
{
	echo '
		<div>
			<button class="sign-in-button" onclick="window.location.href = \'LoginPage.php\'">
				<center> Login / Register <center>
			</button>
		</div>
	';
}

function LogOutButton()
{
	echo '
			<div class="account-section">
				<div class="account-avatar">
					<img src="'.$_COOKIE["avatar"].'">
				</div>
				<div>
					<div class="account-name">
						'.$_COOKIE["fullname"].'
					</div>
					<div>
						@'.$_COOKIE["username"].'
					</div>					
				</div>
			</div>
			<div>
				<button class="log-out-button" onclick="Logout()">
					Log Out
				</button>
			</div>
		';
}

$buttons_texts = array("Account","Lists", "Query");

$acc_drop_items = array("Delete Account");
$lists_drop_items = array("Watch Later", "Completed");
$query_drop_items = array('Request a Movie', 'Send Feedback');
$drop_items = array($acc_drop_items, $lists_drop_items, $query_drop_items);

$acc_hrefs = array("DeleteAccount()");
$lists_hrefs = array("SubmitHeaderListForm('watch')", "SubmitHeaderListForm('completed')");
$query_hrefs = array("GotoFeedback('movie')", "GotoFeedback('feedback')");
$hrefs = array($acc_hrefs, $lists_hrefs, $query_hrefs);

?>

<form action="FeedbackPage.php" id="query-form" target="_blank">
	<input type="hidden" name="query" id="query-name">
</form>

<div class="sideblock">
	<div class="content-block">
		<?php


			if(isset($_COOKIE["username"]))
			{
				if ($_COOKIE["username"] != " ") { LogOutButton(); } 
				else 	{ LoginButton(); }
			}
			else{ LoginButton(); }
		?>

		<div class="sections">
			<?php

				for ($i=0; $i < count($buttons_texts); $i++) { 
					if ($i == 0) {
						if (isset($_COOKIE["username"])) {
							if ($_COOKIE["username"] != " "){
								echo '<div class="drop-down">';
								AddDropDownButton($buttons_texts[$i], $drop_items[$i], $hrefs[$i]);
								echo "</div>";
							}
						}
					}else{
						echo '<div class="drop-down">';
						AddDropDownButton($buttons_texts[$i], $drop_items[$i], $hrefs[$i]);
						echo "</div>";
					}
				}

			?>
			<div class="drop-down">
				<div class="drop-down-button">
					Follow Us
				</div>
				<div id="contact us id" class="content-list" style="display: block;"> 
					<ul>
						<li><a href="https://instagram.com" target="_blank"> Instagram </a></li>
						<li><a href="https://facebook.com" target="_blank"> Facebook </a></li>
						<li><a href="https://www.linkedin.com" target="_blank"> LinkedIn </a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<form method="post" id="logout-form" style="display: none;">
	<input type="hidden" name="logout">
</form>

<script type="text/javascript">
	function GotoFeedback(val) {
		document.getElementById('query-name').value = val;
		document.getElementById('query-form').submit();
	}

	function Logout(){
		var res = confirm("Are you sure you want to Log Out? ");
		if (res) {
			document.getElementById('logout-form').submit();
		}
	}

	function DeleteAccount() {
		var res = confirm("Delete Account ?");
		if (res) {
			window.location.href = './DeleteAccountPage.php'
		}		
	}
</script>



<!--<div class="drop-down">
	<div class="drop-down-button">
		Lists
	</div>
	<div id="list id" class="content-list" style="display: block;"> 
		<ul>
			<li>
				<a href="javascript:SubmitHeaderListForm('watch')"> 
					Watch Later 
				</a>
			</li>
			<li>	
				<a href="javascript:SubmitHeaderListForm('completed')"> 
					Completed 
				</a>
			</li>
		</ul>
	</div>
</div>-->