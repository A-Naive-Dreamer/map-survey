<?php
	require "connect.php";

	$query = "SELECT * FROM `city_list` ORDER BY `city`;";
	$query = $conn -> query($query);

	echo "<table id='city-table'>" . 
			"<thead>" . 
					"<th>" . 
						"Nama Kota" . 
					"</th>" . 
					"<th>" . 
						"Latitude" . 
					"</th>" . 
					"<th>" . 
						"Longitude" . 
					"</th>" . 
					"<th colspan='3'>" . 
						"Operasi" . 
					"</th>" . 
			"</thead>" . 
			"<tbody>";

	if(mysqli_num_rows($query) > 0) {
		while($row = mysqli_fetch_assoc($query)) {
			echo "<tr id='" . $row["id"] . "'>" . 
					"<td>" . 
						$row["city"] . 
					"</td>" . 
					"<td>" . 
						$row["latitude"] . 
					"</td>" . 
					"<td>" . 
						$row["longitude"] . 
					"</td>" . 
					"<td>" . 
						"<button type='button' class='button-for-update-city-form' onclick=\"openUpdateCityForm(" . $row["id"] . ", '" . 
							$row["city"] . "', " . $row["latitude"] . ", " . $row["longitude"] . ")\">" . 
							"Update" . 
						"</button>" . 
					"</td>" . 
					"<td>" . 
						"<button type='button' class='button-for-delete-city-form' onclick='deleteCity(" . $row["id"] . ")'>" . 
							"Delete" . 
						"</button>" . 
					"</td>" . 
					"<td>" . 
						"<button type='button' class='button-for-select-city' onclick='setCityId(" . $row["id"] . ")'>" . 
							"Select" . 
						"</button>" . 
					"</td>" . 
				"</tr>";
		}
	} else {
		echo "<tr><td colspan='6' style='background: transparent; color: #ff0000; font-size: 1em;' ><h1>Tidak ada kota ditemukan</h1></td></tr>";
	}

	echo "</tbody>" .  
		"</table>";

	$conn -> close();
?>