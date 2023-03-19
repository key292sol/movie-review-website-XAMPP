<?php 

include_once 'DBBasics.php';
$movie_req_table = "movie_requests";
$site_feedback = "site_feedback";

function getMovieReqTable()
{
	global $movie_req_table;
	return $movie_req_table;
}

function getSiteFeedbackTable(){
	global $site_feedback;
	return $site_feedback;
}

function CreateTables()
{
	$sql = "DESC TABLE ".getSiteFeedbackTable();
	if (!DoQuery($sql)) {
		$sql = "CREATE TABLE ".getSiteFeedbackTable()."(
					id int unsigned auto_increment PRIMARY KEY,
					feedback varchar(500) NOT NULL
				)";
		DoQuery($sql);
	}

	$sql = "DESC TABLE ".getMovieReqTable();
	if (!DoQuery($sql)) {
		$sql = "CREATE TABLE ".getMovieReqTable()."(
					id int unsigned auto_increment PRIMARY KEY,
					movie_name varchar(255) NOT NULL,
					movie_desc varchar(500)
				)";
		DoQuery($sql);
	}
}

function InsertMovieRequest($movie, $movie_desc = "")
{
	$sql = "INSERT INTO ".getMovieReqTable()."(movie_name, movie_desc)
			VALUES('$movie','$movie_desc')";
	return DoQuery($sql);
}

function InsertWebsiteFeedback($feedback)
{
	$sql = "INSERT INTO ".getSiteFeedbackTable()."(feedback)
			VALUES('$feedback')";
	return DoQuery($sql);
}

CreateTables();

?>