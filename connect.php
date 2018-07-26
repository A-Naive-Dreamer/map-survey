<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "map_survey";

	$conn = new mysqli();

	$conn -> connect($server, $username, $password);
	$conn -> select_db($database);
?>