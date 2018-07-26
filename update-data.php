<?php
	require "connect.php";
	require "functions.php";

	$old_field_name = inspect_value($_GET["old_field_name"]);
	$new_field_name = inspect_value($_GET["new_field_name"]);

	$new_field_value = inspect_value($_GET["new_field_value"]);

	$city_id = inspect_value($_GET["city_id"]);

	$query = "UPDATE `survey_data` SET `field_name` = ?, `field_value` = ? WHERE `field_name` = ? AND `city_id` = ?;";
	$query = $conn -> prepare($query);

	$query -> bind_param("sssi", $new_field_name, $new_field_value, $old_field_name, $city_id);
	$query -> execute();
?>