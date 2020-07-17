<?php

include("zaglavljeproba.php");
include_once("baza.php");

$veza = spojiSeNaBazu();
$upit = "SELECT *FROM zahtjev WHERE prihvacen=0 ";
$rezultat = izvrsiUpit($veza, $upit);

$result = mysqli_query($veza, "SELECT valuta_id FROM valuta WHERE moderator_id= '{$aktivni_korisnik_id}' OR '{$aktivni_korisnik_id}'=1 ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Prihvat zahtjeva</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
	<br>
	<div class="container">
		<div class="naslov">
			<h1>Prihvat zahtjeva</h1>
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
				<th>Prihvat zahtjeva</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (isset($rezultat)) {

				while (list($zahtjev_id, $korisnik_id, $iznos, $prodajem_v, $kupujem_v, $datum, $prihvacen) = mysqli_fetch_array($rezultat)) {
					$result = mysqli_query($veza, "SELECT valuta_id FROM valuta WHERE moderator_id= '{$aktivni_korisnik_id}' OR '{$aktivni_korisnik_id}'=1 ");
					while (list($naziv) = mysqli_fetch_array($result)) {
						$naziv_dog = $naziv;
						if ($prodajem_v == $naziv) {

							$upit5 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= $kupujem_v");
							$rezultat5 = mysqli_fetch_array($upit5);
							$naziv5 = $rezultat5[2];

							$upit50 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= $prodajem_v");
							$rezultat50 = mysqli_fetch_array($upit50);
							$naziv50 = $rezultat50[2];

							$vrijeme2 = strtotime($datum);
							$pretvoreno_vrijeme = date("d.m.Y H:i:s", $vrijeme2);

							echo "<tr>";
							echo "<td>$zahtjev_id</td>";
							echo "<td>$korisnik_id</td>";
							echo "<td>$iznos</td>";
							echo "<td>$naziv50</td>";
							echo "<td>$naziv5</td>";
							echo "<td>$pretvoreno_vrijeme</td>";
							echo "<td>$prihvacen</td>";
							echo "<td><a href='prihvat_zahtjeva.php?id={$zahtjev_id}'>Prihvati zahtjev</a></td>";
						}
					}
				}
			}

			zatvoriVezuNaBazu($veza);
			?>
		</tbody>
	</table>
</body>

</html>