<?php

include_once 'DBBasics.php';

function CreateMovieReviewTable()
{
	$sql = "DESC TABLE movie_reviews";
	if (!DoQuery($sql)) {
		$sql = "CREATE TABLE movie_reviews(
					id int auto_increment PRIMARY KEY,
					rev_username varchar(100),
					rev_user_avatar varchar(100),
					rev_review varchar(600),
					rev_movie_id int,
					rev_rating decimal(3,1),
					rev_review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
				)";
		DoQuery($sql);
	}
}

function GetReviews($table, $col, $id)
{
	CreateMovieReviewTable();
	$sql = "SELECT * FROM ".$table."
			WHERE ".$col."=".$id."
			ORDER BY id DESC";

	return DoQuery($sql);
}

function GetMovieReviews($movie_id)
{
	return GetReviews("movie_reviews", "rev_movie_id", $movie_id);
}

function InsertReview($movie_id, $review, $rate ,$username, $avatar)
{
	$sql = "INSERT INTO movie_reviews(rev_username, rev_user_avatar, rev_review, rev_movie_id, rev_rating)
			VALUES ('$username', '$avatar', '$review', '$movie_id', $rate)";
	DoQuery($sql);
}

function DoReviewsExists($movie_id)
{
	$sql = "SELECT * FROM movie_reviews
			WHERE rev_movie_id = ".$movie_id;
	$res = DoQuery($sql);
	if ($res) {
		if ($res->num_rows > 0) { return true; } 
		else { return false; }
	} else {
		return false;
	}
}

function GetAverageRating($movie_id)
{
	$sql = "SELECT AVG(rev_rating) FROM movie_reviews
			WHERE rev_movie_id=".$movie_id;

	return DoQuery($sql);
}

function DeleteReview($rev_id)
{
	$sql = "DELETE FROM movie_reviews
			WHERE id=".$rev_id;
	DoQuery($sql);
}

function RemoveUserFromReview($username)
{
	$sql = "UPDATE movie_reviews
			SET rev_username=' '
			WHERE rev_username='".$username."'";
	DoQuery($sql);
}

CreateMovieReviewTable();
?>