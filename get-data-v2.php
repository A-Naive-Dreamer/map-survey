<?php
	require "connect.php";

	$query1 = "SELECT * FROM `city_list` ORDER BY `city`;";
	$query1 = $conn -> query($query1);

	echo "[";

	if(mysqli_num_rows($query1) > 0) {
		$x = 0;

		while($row1 = mysqli_fetch_assoc($query1)) {
			$query2 = "SELECT * FROM `survey_data` WHERE `city_id` = " . $row1["id"] . " ORDER BY `field_name`;";
			$query2 = $conn -> query($query2);

			echo "\"";

			if(mysqli_num_rows($query2) > 0) {
				$y = mysqli_num_rows($query1);

				while($row2 = mysqli_fetch_assoc($query2)) {
					echo $row2["field_name"] . ": " . $row2["field_value"] . "<br/>";
				}

			} else {
				echo "Tidak ada data untuk ditampilkan";
			}

			echo "\"";

			++$x;

			if($x !== $y) {
				echo ", ";
			}
		}
	}

	echo "]";

	$conn -> close();
?>