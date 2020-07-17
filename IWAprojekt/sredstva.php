<?php
include_once("zaglavljeproba.php");
include_once("baza.php");

$veza = spojiSeNaBazu();

if (!empty($aktivni_korisnik_id)) {
	$upit = "SELECT *FROM sredstva WHERE korisnik_id='{$aktivni_korisnik_id}'";
	$rezultat = izvrsiUpit($veza, $upit);

		
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Sredstva</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200&display=swap" rel="stylesheet">
</head>
<main>
</main>

<body>
	<br>

			<h1>Sredstva</h1>


	<?php
	if (!empty($aktivni_korisnik_id)) {
		echo "<br>"
	?>

		<table class="tablica">
			<thead>
				<tr>
					<th>Naziv</th>
					<th>Iznos</th>
					<th>Promijeni iznos</th>

				</tr>
			</thead>
			<tbody>
				<?php
				if (isset($rezultat)) {
					while ($red = mysqli_fetch_array($rezultat)) {
						$proba = $red[2];
						
						$upit2 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= $proba");
						$rezultat2 = mysqli_fetch_array($upit2);
						$naziv = $rezultat2[2];
						
						echo "<tr>";
						echo "<td>{$naziv}</td>";
						echo "<td>{$red[3]}</td>";
						echo "<td><a href='promijeni_iznos.php?id={$red[0]}'>Promijeni iznos</a></td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	<?php } else {
		echo "Korisnik nije unesen";
	}
	?>
	</div>
	<?php 
	include("dodaj_sredstva.php");
	?>
</body>

</html>