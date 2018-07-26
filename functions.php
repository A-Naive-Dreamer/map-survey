<?php
	function inspect_value($value) {
		$value = htmlspecialchars($value);
		$value = stripslashes($value);
		$value = trim($value);

		return $value;
    }
?>