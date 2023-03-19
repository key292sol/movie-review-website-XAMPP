<?php

include_once 'DBBasics.php';

$userTable = "user_info";
$loginTable = "login_info";

function getUserTable(){ 
	global $userTable;
	return $userTable; 
}
function getLoginTable(){ 
	global $loginTable;
	return $loginTable; 
}

//Create the tables
function CreateTables(){
	$sql = "DESC TABLE ".getUserTable();
	if(!DoQuery($sql)){
		$sql = "CREATE TABLE ".getUserTable()."( 
			id int(6) unsigned auto_increment PRIMARY KEY,
			username varchar(80),
			first_name varchar(80),
			last_name varchar(80),
			email_id varchar(80),
			phone_no char(10),
			avatar_addr varchar(255),
			file_addr varchar(255)
		)";
		DoQuery($sql);
	}

	$sql = "DESC TABLE ".getLoginTable();
	if(!DoQuery($sql)){
		$sql = "CREATE TABLE ".getLoginTable()." (
			id int unsigned auto_increment PRIMARY KEY,
			username varchar(80),
			password varchar(80)
		)";
		DoQuery($sql);
	}

	//Admin account 
	if (!DoesUsernameExist("admin")) {
		AddAccount("admin", "admin1029", "DDProject", "admin", "your@email.com", "./Avatars/black-avatar.png");
	}
}

function GotoHomePage()
{
	echo 'window.location.href = "./index.php";';
}

function GetUserLoginUserById($user_id)
{
	$sql = "SELECT * FROM ".getLoginTable()."
			WHERE id=".$user_id;
	return DoQuery($sql)->fetch_assoc()["username"];
}

//Update the password
function UpdatePassword($user_id, $newpassword){
	$sql = "UPDATE ".getLoginTable()."
			SET password='".$newpassword."'
			WHERE id='".$user_id."'";
	DoQuery($sql);

	$username = GetUserLoginUserById($user_id);
	if(LoginFunc($username, $newpassword)){
		return true;
	}
	else{
		return false;
	}
}

//Check if username exists
function DoesUsernameExist($username){
	$sql = "SELECT username from ".getLoginTable()."
			WHERE username = '$username'";
	$res = DoQuery($sql);
	if ($res) {
		if($res->num_rows > 0){
			return true;
		}else{
			return false;
		}
	}else{
		echo "error in fetching <br>";
		return false;
	}
}

function AddAccount($username, $password, $fname, $lname, $email, $avatar_addr, $phone = ""){
	$sql = "INSERT INTO ".getLoginTable()." (username, password)
			VALUES ('$username', '$password')";
	DoQuery($sql);
	
	$sql = "INSERT INTO ".getUserTable()."(username, first_name, last_name, email_id, phone_no, avatar_addr, file_addr)
			VALUES ('$username', '$fname', '$lname', '$email', '$phone', '$avatar_addr', './Users/$username/list.txt')";
	DoQuery($sql);
}

function LoginFunc($username, $password){
	$sql = "SELECT * FROM ".getLoginTable()." 
			WHERE username='$username' AND password='$password'";
	if(DoQuery($sql)->num_rows>0){
		return true;
	}
	else{
		return false;
	}
}

function GetDetails($username){
	$sql = "SELECT * FROM ".getUserTable()."
			WHERE username='$username'";
	return DoQuery($sql)->fetch_assoc();
}

function SetCookies($username)
{
	$res = GetDetails($username);
	$name = $res["first_name"]." ".$res["last_name"];

	setcookie("username", $username);
	setcookie("avatar", $res["avatar_addr"]);
	setcookie("fullname", $name);
	setcookie("file_path", "./User Accounts/".$username."/lists.txt");
}

function DeleteAccount($username)
{
	include './Database/ReviewsDB.php';
	$sql = "DELETE FROM ".getUserTable()."
			WHERE username = '$username'";
	DoQuery($sql);

	$sql = "DELETE FROM ".getLoginTable()."
			WHERE username = '$username'";
	DoQuery($sql);

	unlink("./User Accounts/".$username."/lists.txt");
	rmdir("./User Accounts/".$username);
	RemoveUserFromReview($username);
}

function RemoveCookies($alert_value = "")
{
	setcookie("username", " ");
	setcookie("avatar", " ");
	setcookie("fullname", " ");
	setcookie("file_path", " ");

	if ($alert_value != "") {
		if ($_COOKIE["username"] != " " || $_COOKIE["avatar"] != " " || $_COOKIE["fullname"] != " " || $_COOKIE["file_path"] != " ") {
			echo "alert('".$alert_value."');";
			return 0;
		}
	}
	echo "window.location.href = './index.php';";
}

CreateTables();

?>