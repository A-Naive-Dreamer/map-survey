<?php
	require "connect.php";
	require "functions.php";

	$city_id = inspect_value($_GET["city_id"]);

	$query = "DELETE FROM `survey_data` WHERE `city_id` = ?;";
	$query = $conn -> prepare($query);

	$query -> bind_param("i", $city_id);
	$query -> execute();

	$query = "DELETE FROM `city_list` WHERE `id` = ?;";
	$query = $conn -> prepare($query);

	$query -> bind_param("i", $city_id);
	$query -> execute();
?>