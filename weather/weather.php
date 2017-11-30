<!doctype html>
<html>
<head>
	<title>Statesboro Weather</title>
	<?php include("assets.inc.php"); ?>
</head>
<body>
	<?php
		$weather = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=Statesboro&appid=193897609136134aa6708ebe2e81daf5&units=imperial");
		$weather = json_decode($weather);

		$OWIcon = $weather->weather[0]->id;
		$OWCondition = $weather->weather[0]->main;
		$OWDetail = $weather->weather[0]->description;
		$OWTemp = $weather->main->temp;
	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="pt-3 pb-1"><i class="fal fa-thermometer-three-quarters"></i> Statesboro Weather</h1>
			</div>
		</div>
		<div class="row">
				<div class="col-sm-12">
					<i id="weather-icon" class="owf owf-4x owf-<?php echo $OWIcon ?> p-3 float-left"></i>
					<h4 class="card-title pt-3"><?php echo $OWCondition ?></h4>
					<h6 class="card-subtitle pb-2 text-muted"><?php echo ucwords($OWDetail); ?> - <?php echo round($OWTemp)?>&deg;</h6>
				</div>
			</div>
		</div>
	</div>

	<?php include("footer.inc.php"); ?>
</body>
</html>
