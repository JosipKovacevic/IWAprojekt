<?php 

	include("zaglavljeproba.php");	
	include_once("baza.php");

	$veza = spojiSeNaBazu();
	$upit = "SELECT *FROM zahtjev WHERE korisnik_id = '{$aktivni_korisnik_id}'";
	$rezultat = izvrsiUpit($veza, $upit);
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Moji zahtjevi</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovačević">
		<meta name="datum" content="04.06.2020.">
		<link href="jkovacevi.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
 		<br>
 		<div class="container">
			<div class="naslov">
				<h1>Moji zahtjevi</h1>
			</div>
		</div>
		<br>
 		<table class="tablica">
 			<thead>
 				<tr>
 					<th>Zahtjev ID</th>
 					<th>Korisnik ID</th>
 					<th>Iznos</th>
 					<th>Prodajem valutu</th>
 					<th>Kupujem valutu</th>
 					<th>Datum i vrijeme kreiranja</th>
 					<th>Prihvaceno</th>
 					
 				</tr>
 			</thead>
 			<tbody>
 				<?php
 					if(isset($rezultat)){
 						while($red=mysqli_fetch_array($rezultat)){

							$proba = $red[3];
						
							$upit2 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= $proba");
							$rezultat2 = mysqli_fetch_array($upit2);
							$naziv = $rezultat2[2];

							$proba2 = $red[4];
						
							$upit20 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= $proba2");
							$rezultat20 = mysqli_fetch_array($upit20);
							$naziv2 = $rezultat20[2];

							$vrijeme2 = strtotime($red[5]);
							$pretvoreno_vrijeme = date("d.m.Y H:i:s", $vrijeme2);


 							echo "<tr>";
 							echo "<td>{$red[0]}</td>";
 							echo "<td>{$red[1]}</td>";
 							echo "<td>{$red[2]}</td>";
 							echo "<td>{$naziv}</td>";
 							echo "<td>{$naziv2}</td>";
 							echo "<td>{$pretvoreno_vrijeme}</td>";
 							echo "<td>{$red[6]}</td>";
 							echo "</tr>";
 						}
 					}
 				?>
 			</tbody>
 		</table>
	 </body>
	</html>