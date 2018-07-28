<!DOCTYPE html>
<html lang="ind">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>
			Map Survey App
		</title>
		<link rel="stylesheet" href="/map-survey/style.css" />
	</head>
	<body>
		<div id="app">
			<div id="map-container" style="height: 732px; width: 100%">
			</div>
			<div class="caption">
				<h1>Daftar Kota</h1>
			</div>
			<div id="city-list" class="data-container">
				<div id="city-list-container">
					<?php
						require "get-city.php";
					?>
				</div><!--
				--><button type="button" id="button-for-add-city-form" onclick='openAddCityForm()'>
					Add
				</button>
			</div>
			<div class="caption">
				<h1>Daftar Survei</h1>
			</div>
			<div id="survey-data" class="data-container">
				<div id="survey-data-container">
					<?php
						require "get-data.php";
					?>
				</div><!--
				--><button type="button" id="button-for-add-survey-data-form" onclick='openAddSurveyDataForm()'>
					Add
				</button>
			</div>
			<div class="caption">
				<h1>City Form</h1>
			</div>
			<div id="city-form" class="form">
				<input type="text" placeholder="City Name" id="city-name" required="required" />
				<input type="number" placeholder="Latitude" id="latitude" required="required" />
				<input type="number" placeholder="Longitude" id="longitude" required="required" />
				<div class="action">
					<button type="button" id="button-for-add-city">
						Add
					</button><!--
					--><button type="button" id="button-for-update-city">
						Update
					</button><!--
					--><button type="button" id="button-for-reset-city-form">
						Reset
					</button>
				</div>
			</div>
			<div class="caption">
				<h1>Survey Data Form</h1>
			</div>
			<div id="survey-data-form" class="form">
				<input type="text" placeholder="Field Name" id="field-name" required="required" />
				<input type="text" placeholder="Field Value" id="field-value" required="required" />
				<div class="action">
					<button type="button" id="button-for-add-survey-data">
						Add
					</button><!--
					--><button type="button" id="button-for-update-survey-data">
						Update
					</button><!--
					--><button type="button" id="button-for-reset-survey-data-form">
						Reset
					</button>
				</div>
			</div>
			<script src="/map-survey/functions.js">
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=createMap" async defer>
			</script>
		</div>
	</body>
</html>
