<?php 
	include_once("zaglavljeproba.php");
	include_once("baza.php");

	$veza = spojiSeNaBazu();

	if(!empty($aktivni_korisnik_id)){
		$upit = "SELECT *FROM sredstva WHERE korisnik_id='{$aktivni_korisnik_id}'";
		$rezultat = izvrsiUpit($veza, $upit);
	}
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
	<main>
	</main>
	<body>
		<?php
		if(!empty($aktivni_korisnik_id)){
			?>
		<table class="tablica">
 			<thead>
 				<tr>
 					<th>Valuta ID</th>
 					<th>Iznos</th>
 					<th>Promijeni iznos</th>
 					
 				</tr>
 			</thead>
 			<tbody>
	 			<?php
		 				if(isset($rezultat)){
		 					while($red=mysqli_fetch_array($rezultat)){
		 						echo "<tr>";
		 						echo "<td>{$red[2]}</td>";

		 						echo "<td>{$red[3]}</td>";
		 						echo "<td><a href='promijeni_iznos.php?id={$red[0]}'>Promijeni iznos</a></td>";
		 						echo "<td><a href='zahtjevnovi.php?id={$red[2]}'>Promijeni Valutu</a></td>";
		 						echo "</tr>";
		 						}
		 					}
		 				
	 				?>
	 			</tbody>
 			</table>
 			<?php }else{
		 					echo "Korisnik nije unesen";
		 				}
		 	?>
		</div>
	</body>
</html>
