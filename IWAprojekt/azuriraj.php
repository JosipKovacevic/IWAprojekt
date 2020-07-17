<?php 

	include("zaglavljeproba.php");	
	include_once("baza.php");

	$veza = spojiSeNaBazu();
	$upit = "SELECT *FROM korisnik";
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
 					<th>Tip Korisnika</th>
 					<th>Korisnicko ime</th>
 					<th>Lozinka</th>
 					<th>email</th>
					 <th>slika</th>
 					<th>Azuriraj</th> 
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
 							echo "<td>{$red[1]}</td>";
 							echo "<td>{$red[2]}</td>";
 							echo "<td>{$red[3]}</td>";
							echo "<td>{$red[6]}</td>";
							echo "<td><a href='azuriraj_valute.php?id=" . $red[0] . "'><img src=\"" . $red[7] . "\" width=50 height=50  ></a></td>";
							//echo "<td>{$red[7]}</td>";
 							echo "<td><a href='azuriraj_korisnika.php?id={$red[0]}'>Azuriraj</a></td>";
 							echo "</tr>";
 						}
 					}
 				?>
 			</tbody>
 		</table>
	 </body>
	</html>