<?php
	require "connect.php";
	require "functions.php";

	$new_city_name = inspect_value($_GET["new_city_name"]);
	$city_id = inspect_value($_GET["city_id"]);
	$new_latitude = inspect_value($_GET["new_latitude"]);
	$new_longitude = inspect_value($_GET["new_longitude"]);

	$query = "UPDATE `city_list` SET `city` = ?, `latitude` = ?, longitude = ? WHERE `id` = ?;";
	$query = $conn -> prepare($query);

	$query -> bind_param("sddi", $new_city_name, $new_latitude, $new_longitude, $city_id);
	$query -> execute();
?>