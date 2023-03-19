<link rel="stylesheet" type="text/css" href="./CSS/Reviews.css">
<link rel="stylesheet" type="text/css" href="./CSS/headerstyle.css">
<link rel="stylesheet" type="text/css" href="./CSS/ScrolBarStyle.css">


<div class="reviews">
	<div class="enter-review">
		<form method="post">
			<textarea name="review" placeholder="Enter your review here" required></textarea>
			<div>
				<label>Rating: </label>
				<input type="range" name="rev-rate" class="rate-slider" min=0 max=10 step=0.5 value=0 oninput="rev_rate_change(this.value)">
				<label id="slider-val-disp">0/10</label>
			</div>
			<br>	
			<input type="submit" value="Submit">
		</form>
	</div>
	<div class="all-reviews">
		<?php

		$userCookieSet = isset($_COOKIE["username"]);
		$del_butt_code = "";

		if ($res) {
			foreach ($res as $r) {
				$sign = "@";
				if ($r["rev_username"] != " ") {
					$rev_username = $r["rev_username"];
				} else {
					$rev_username = "[deleted]";
					$sign = "";
				}

				if ($userCookieSet) {
					if ($rev_username == $_COOKIE["username"]) {
						$del_butt_code = '<div class="delete-rev-button" onclick="DeleteRev('.$r["id"].')"> Delete </div>';
					} else {
						$del_butt_code = "";
					}
				}

				echo '
					<div class="review-body">
						<div class="rev-acc">
							<div class="acc-img">
								<img src="'.$r["rev_user_avatar"].'">
							</div>
							<p class="rev-username" style="float: left;">
								'.$sign.$rev_username.'
							</p>
							'.$del_butt_code.'
							<br>
							<p class="rev-date"> '.date("j/n/y H:i ",strtotime($r["rev_review_date"])).' </p>
						</div>
						<div> <b>Rating:</b> '.round($r["rev_rating"],1).'/10</div>
						<div class="review">
							'.$r["rev_review"].'
						</div>
					</div>
				';	
			}
		}			
		?>
	</div>
</div>

<form id="rev-delete-form" method="post" style="display: none;">
	<input type="hidden" id="delete-rev" name="delete-rev">
</form>

<script type="text/javascript">
	var sliderLabel = document.getElementById('slider-val-disp');
	function rev_rate_change(val) {
		sliderLabel.innerHTML = val + "/10";
	}

	function DeleteRev(rev_id) {
		var ans = confirm("Delete your review ?");
		if (ans) {
			document.getElementById('delete-rev').value = rev_id;
			document.getElementById('rev-delete-form').submit();
		}
	}
</script>