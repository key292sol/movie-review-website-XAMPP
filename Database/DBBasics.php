<?php

$conn;

function ConfigDBConnection(){
	global $conn;
	$host = "localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="ddpro";
			
	$sql = "Create database ddpro";
	$conn = new mysqli($host,$dbusername,$dbpassword);
	DoQuery($sql);
	$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
}

function DoQuery($sql){
	global $conn;
	return $conn->query($sql);
}

ConfigDBConnection();

?>