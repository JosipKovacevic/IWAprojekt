<?php 

	include("zaglavljeproba.php");	
	include_once("baza.php");

	$veza = spojiSeNaBazu();
	$upit = "SELECT *FROM valuta WHERE moderator_id= '{$aktivni_korisnik_id}' OR '{$aktivni_korisnik_id}'=1";
	$rezultat = izvrsiUpit($veza, $upit);
	zatvoriVezuNaBazu($veza);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Azuriraj valutu</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovačević">
		<meta name="datum" content="04.06.2020.">
		<link href="jkovacevi.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
 		<br>
 		<div class="container">
			<div class="naslov">
				<h1>Azuriraj valutu</h1>
			</div>
		</div>
 		<br>
 		<table class="tablica">
 			<thead>
 				<tr>
 					<th>Valuta ID</th>
 					<th>Moderator ID</th>
 					<th>Naziv</th>
 					<th>Tečaj</th>
 					<th>Aktivno od</th>
 					<th>Aktivno do</th>
					<th>Datum azuriranja</th>
					<th>Azuriraj</th> 
 				</tr>
 			</thead>
 			<tbody>
 				<?php
 					if(isset($rezultat)){
 						while($red=mysqli_fetch_array($rezultat)){
 							echo "<tr>";
 							echo "<td>{$red[0]}</td>";
 							echo "<td>{$red[1]}</td>";
 							echo "<td>{$red[2]}</td>";
 							echo "<td>{$red[3]}</td>";
 							echo "<td>{$red[6]}</td>";
 							echo "<td>{$red[7]}</td>";
 							echo "<td>{$red[8]}</td>";
 							echo "<td><a href='moderator_valute.php?id={$red[0]}'>Azuriraj</a></td>";
 							echo "</tr>";
 						}
 					}
 				?>
 			</tbody>
 		</table>
	 </body>
	</html>