<?php
	require "connect.php";
	require "functions.php";

	$field_name = inspect_value($_GET["field_name"]);
	$city_id = inspect_value($_GET["city_id"]);

	$query = "SELECT * FROM `survey_data` WHERE `field_name` = '" . $field_name . "' AND `city_id` = " . $city_id . ";";
	$query = $conn -> query($query);

	if(mysqli_num_rows($query) === 0) {
		$field_value = inspect_value($_GET["field_value"]);

		$query = "INSERT INTO `survey_data` VALUES(?, ?, ?)";
		$query = $conn -> prepare($query);

		$query -> bind_param("ssi", $field_name, $field_value, $city_id);
		$query -> execute();
	}
?>