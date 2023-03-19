<?php
include_once 'DBBasics.php';

$table = "movies_info";

function getTable(){ 
	global $table;
	return $table; 
}

function CreateMovieInfoTable()
{
	//Create Table
}

function GetMovieById($id)
{
	$sql = "SELECT * FROM ".getTable()."
			WHERE id=".$id."
			LIMIT 1";
	return DoQuery($sql)->fetch_assoc();
}

function SearchMovie($col_name, $value)
{
	$sql = "select * from ".getTable()."
			where ".$col_name." like('%".$value."%')
			order by release_date desc";
	return DoQuery($sql);
}

function GetHomePageValues($orderbyCols, $limit)
{
	$sql = "SELECT id, movie_name, vid_poster, poster
			FROM ".getTable()."
			ORDER BY ".$orderbyCols." DESC 
			LIMIT ".$limit."
			";
	return DoQuery($sql);
}

function SetTheList($file_path, $list_value, $movie_id)
{
	$new_line = "
";
	// Read the file and check if movie id already exists
	$lists_file = file($file_path);
	$line_no = 0;
	foreach ($lists_file as $line) {
		if (substr($line, 4) == $movie_id.$new_line) {
			break;
		}
		$line_no += 1;
	}

	// If movie id exists then change the first char 
	// else add new line
	$line_writer = $lists_file;
	if ($line_no < count($lists_file)) {
		if ($line_writer[$line_no][0] == $list_value) {
			unset($line_writer[$line_no]);
		} else {
			$line_writer[$line_no][0] = $list_value;
		}
	}else{
		array_push($line_writer, $list_value." = ".$movie_id.$new_line);
	}

	// Write the array to the file
	$lists_file = fopen($file_path, "w");
	foreach ($line_writer as $line) {
		fwrite($lists_file, $line);
	}
	fclose($lists_file);
}

?>