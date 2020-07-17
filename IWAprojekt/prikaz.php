<?php 

	include("zaglavljeproba.php");	
	include_once("baza.php");

	$veza = spojiSeNaBazu();
	$upit = "SELECT *FROM korisnik WHERE tip_korisnika_id=1";
	$rezultat = izvrsiUpit($veza, $upit);
	zatvoriVezuNaBazu($veza);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Virtualna mjenjačnica</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovačević">
		<meta name="datum" content="04.06.2020.">
		
 	</head>
 	<body >
 		<?php
 			echo "<br>" 
 		?>
		<div class="container">
			<div class="naslov">
				<h1>Azuriraj korisnika </h1>
			</div>
		</div>
 		<?php
 			echo "<br>" 
 		?>
 		<table class="tablica" >
 			<thead>
 				<tr>
 					<th >Korisnik ID</th>
 					<th>Ime</th>
 					<th>Prezime</th>

 					<th>Prikazi sumu</th> 
 				</tr>
 			</thead>
 			<tbody>
 				<?php
 					if(isset($rezultat)){
 						while($red=mysqli_fetch_array($rezultat)){
 							echo "<tr>";
 							echo "<td>{$red[0]}</td>";
 							echo "<td>{$red["ime"]}</td>";
 							echo "<td>{$red["prezime"]}</td>";
                            echo "<td><a href='prikaz2.php?id={$red[0]}'>Prikazi sumu</a></td>";
                            
                             
 							echo "</tr>";
 						}
 					}
 				?>
 			</tbody>
 		</table>
	 </body>
	</html>