<?php
	require "connect.php";
	require "functions.php";

	if(isset($_GET["city_id"])) {
		$city_id = inspect_value($_GET["city_id"]);
	} else {
		$city_id = 0;
	}

	$query1 = "SELECT `city` FROM `city_list` WHERE `id` = " . $city_id . ";";
	$query1 = $conn -> query($query1);

	$query2 = "SELECT * FROM `survey_data` WHERE `city_id` = " . $city_id . " ORDER BY `field_name`;";
	$query2 = $conn -> query($query2);

	$row = mysqli_fetch_assoc($query1);

	echo "<table id='survey-data-table'>" . 
			"<thead>" . 
				"<tr>" . 
					"<th colspan='4'>";
	echo (empty($row["city"])) ? "No City Selected" : $row["city"];
	echo "</th>" .
				"</tr>" . 
				"<tr>" . 
					"<th colspan='1'>" . 
						"Nama Field" . 
					"</th>" . 
					"<th>" . 
						"Nilai Field" . 
					"</th>" . 
					"<th colspan='2'>" . 
						"Operasi" . 
					"</th>" .
				"</tr>" . 
			"</thead>" . 
			"<tbody>";

	if(mysqli_num_rows($query2) > 0) {
		while($row = mysqli_fetch_assoc($query2)) {
			echo "<tr id='" . $row["city_id"] . "'>" . 
					"<td>" . 
						$row["field_name"] . 
					"</td>" . 
					"<td>" . 
						$row["field_value"] . 
					"</td>" . 
					"<td>" . 
						"<button type='button' class='button-for-update-survey-data-form' onclick=\"openUpdateSurveyDataForm('" . $row["field_name"] . "', '" . $row["field_value"] . "')\">" . 
							"Update" . 
						"</button>" . 
					"</td>" . 
					"<td>" . 
						"<button type='button' class='button-for-delete-survey-data-form' onclick=\"deleteSurveyData('" . $row["field_name"] . "')\">" . 
							"Delete" . 
						"</button>" . 
					"</td>" . 
				"</tr>";
		}
	} else {
		echo "<tr><td colspan='4' style='background: transparent; color: #ff0000; font-size: 1em;'><h1>Tidak ada data survei ditemukan</h1></td></tr>";
	}

	echo "</tbody>" . 
		"</table>";

	$conn -> close();
?>