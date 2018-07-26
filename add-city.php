<?php
	require "connect.php";
	require "functions.php";

	$city_name = inspect_value($_GET["city_name"]);

	$query = "SELECT * FROM `city_list` WHERE `city` = '" . $city_name . "';";
	$query = $conn -> query($query);

	if(mysqli_num_rows($query) === 0) {
		$latitude = inspect_value($_GET["latitude"]);
		$longitude = inspect_value($_GET["longitude"]);

		$query = "INSERT INTO `city_list` VALUES(NULL, ?, ?, ?);";
		$query = $conn -> prepare($query);

		$query -> bind_param("sdd", $city_name, $latitude, $longitude);
		$query -> execute();
	}
?>