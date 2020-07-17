<!DOCTYPE html>
<html lang="en">

<head>
	<title>Virtualna mjenjačnica</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>
<main>
</main>

<body>
	<div class="container">
		<div class="naslov">
			<h1>Virtualna mjenjačnica </h1>
		</div>
	</div>
	<?php
	include_once("zaglavljeproba.php");
	echo "<br>";
	include_once("baza.php");

	/*$date = "10:30:00";
	$vrijeme = strtotime($date); 
	echo "<br>Vrijeme iz strtotime " . $vrijeme;
	echo "<br>Pravo vrijeme". date("H:i:s", $vrijeme);*/

	include("valute.php");

	
	?>

</body>

</html>