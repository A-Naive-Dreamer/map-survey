<?php
	require "connect.php";
	require "functions.php";

	$field_name = inspect_value($_GET["field_name"]);
	$city_id = inspect_value($_GET["city_id"]);

	$query = "DELETE FROM `survey_data` WHERE `field_name` = ? AND `city_id` = ?;";
	$query = $conn -> prepare($query);

	$query -> bind_param("ss", $field_name, $city_id);
	$query -> execute();
?>