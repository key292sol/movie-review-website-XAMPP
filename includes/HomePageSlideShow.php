<link rel="stylesheet" type="text/css" href="./CSS/HomePageSlideShow.css">

<?php

include_once './Database/MoviesDB.php';

function AddSlide($movie_id, $img_src, $bottom_text)
{
	echo '
			<div class="slides" onclick="submit_value('.$movie_id.')" style="display: none;" align="center">
				<img src="'.$img_src.'">
			</div>
		';
}

?>

<script>
			function submit_value(val) {
				document.getElementById('movie-value').value = val;
				document.getElementById('movie-form').submit();
			}
		</script>

<center>
	<div class="slideshow-hold" align="center">
		<h1> LATEST RELEASES </h1>
		<div class="slideshow">
			<div class="slides-container">

				<?php
					$slides_array = GetHomePageValues("release_date", 5);
					
					foreach ($slides_array as $row) {
						AddSlide($row["id"], $row["vid_poster"], $row["movie_name"]);
					}
				?>

				<a class="prev" onclick="ChangeSlide(-1)"> &#10094; </a>
				<a class="next" onclick="ChangeSlide(1)"> &#10095; </a>
			</div>
		</div>
		<div class="dots-holder">
			<?php
				for ($i=0; $i < $slides_array->num_rows; $i++) { 
					echo '<div class="dot" onclick="GotoSlide('.$i.')"></div>';
				}
			?>
		</div>
	</div>
</center>


<script type="text/javascript">
	var slides = document.getElementsByClassName('slides');
	var dots = document.getElementsByClassName('dot');
	var slideIndex = -1;
	var inter = setInterval(NextSlide, 5000);

	function SetTimes() {
		inter = setInterval(NextSlide, 5000);
	}

	function SetSlidesDisplays() {
		if (slideIndex >= slides.length) {
			slideIndex = 0;
		}else if (slideIndex < 0) {
			slideIndex = slides.length - 1;
		}

		slides[slideIndex].style.display = "block";
		dots[slideIndex].className += " dotsactive";
	}

	function FadeOutAnimation() {
		slides[slideIndex].classList.add("slidefadeout");
		setTimeout(
			function(){
				slides[slideIndex].classList.remove("slidefadeout");
			},500
		);
	}

	function HideCurrentSlide() {
		slides[slideIndex].style.display = "none";
		dots[slideIndex].className = dots[slideIndex].className.replace(" dotsactive","");
	}

	
	function NextSlide() {
		if (slideIndex >= 0) {
			HideCurrentSlide();
		}
		slideIndex++;
		SetSlidesDisplays();
	}

	function ChangeSlide(val) {
		clearInterval(inter);
		FadeOutAnimation();
		setTimeout(
			function(){
				HideCurrentSlide();
				slideIndex += val;
				SetSlidesDisplays();
				SetTimes();
			},500
		);
	}


	function GotoSlide(slide_no) {
		clearInterval(inter);
		FadeOutAnimation();
		setTimeout(
			function(){
				HideCurrentSlide();
				slideIndex = slide_no;
				SetSlidesDisplays();
				SetTimes();
			},500
		);
	}
	
	NextSlide();
</script>