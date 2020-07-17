<?php 
	include_once("zaglavljeproba.php");
	include_once("baza.php");
	$veza = spojiSeNaBazu();
	$id_azuriranja_valute = $_GET["id"];


	$upit = "SELECT *FROM valuta WHERE valuta_id='{$id_azuriranja_valute}'";
	$rezultat = izvrsiUpit($veza, $upit);
	$rezultat_ispis = mysqli_fetch_assoc($rezultat);

	zatvoriVezuNaBazu($veza);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Virtualna mjenjačnica</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovačević">
		<meta name="datum" content="04.06.2020.">
		<link href="jkovacevi.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
 		<br>
 		<div style="text-align: center">
			 <?php echo $rezultat_ispis["naziv"];
			 echo " "
			 ?>
			 <div class="container2">
			 <?php
				echo $rezultat_ispis["tecaj"];
				echo " "
				?>
				<div class="container2">
				<?php
				echo "<img src=\"" . $rezultat_ispis["slika"] . "\" width=150 height=90 border=1px margin=6px >";
				echo " "
				?>
				<div class="container2">
				<audio controls="controls">
    				<source src="<?php echo $rezultat_ispis["zvuk"]; ?>"  />
				</audio>
			</div>
			</div>
			</div>
		</div>
	</body>
</html>