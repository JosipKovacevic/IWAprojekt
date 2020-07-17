<?php
include("zaglavljeproba.php");
include_once("baza.php");
$veza = spojiSeNaBazu();
$id_prihvat = $_GET["id"];
$proba = 0;

if (isset($_POST["submit"])) {
	$prihvacen = $_POST['prihvacen'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Prihvacanje zahtjeva</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
	<br>
	<div class="container">
		<div class="naslov">
			<h1>Forma za prihvacanje zahtjeva:</h1>
		</div>
	</div>
	<br>
	<?php
	echo "Forma za  prihvacanje zahtjeva pod ključem: $id_prihvat";
	?>
	<form id="obrazac" name="obrazac" method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id={$id_prihvat}"; ?>">
		<label for="prihvacen">Prihvati:</label>
		<select name="prihvacen">
			<option value="0">Odbij</option>
			<option value="1">Prihvati</option>
		</select>
		<input class="pok" name="submit" type="submit" value="Unesi" />
		<input id="reset" class="pok" type="reset" name="reset" value="Inicijaliziraj" />
	</form>
	<div>
		<?php
		if (isset($greska)) {
			echo "<p style='color:red'>$greska</p>";
		}
		if (isset($poruka)) {
			echo "<p style='color:green'>$poruka</p>";
		}
		?>
	</div>
	<?php

	$result2 = mysqli_query($veza, "SELECT * FROM zahtjev WHERE zahtjev_id= '{$id_prihvat}'");
	$row = mysqli_fetch_array($result2);
	$prodajem_valutu = $row[3];
	echo "<span><strong>Prodajna valuta: </strong>$prodajem_valutu</span><br/>";

	$result3 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= '{$prodajem_valutu}'");
	$row = mysqli_fetch_array($result3);
	$tecaj = $row[3];
	echo "<span><strong>Tecaj prodaje: </strong>$tecaj</span><br/>";

	$result7 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= '{$prodajem_valutu}'");
	$row = mysqli_fetch_array($result7);
	$naziv_prodaje = $row[2];
	echo "<span><strong>Naziv prodajne valute: </strong>$naziv_prodaje</span><br/>";

	$result4 = mysqli_query($veza, "SELECT * FROM zahtjev WHERE zahtjev_id= '{$id_prihvat}'");
	$row = mysqli_fetch_array($result4);
	$iznos2 = $row[2];
	echo "<span><strong>Iznos prodaje: </strong>, $iznos2</span><br/>";

	$pretvorba = $iznos2 * $tecaj;
	echo "<span><strong>Iznos pretvoren u kune: </strong>$pretvorba</span><br/>";

	$result5 = mysqli_query($veza, "SELECT * FROM zahtjev WHERE zahtjev_id= '{$id_prihvat}'");
	$row = mysqli_fetch_array($result5);
	$kupujem_valutu = $row[4];
	echo "<span><strong>Kupovna valuta: </strong>$kupujem_valutu</span><br/>";

	$result8 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= '{$kupujem_valutu}'");
	$row = mysqli_fetch_array($result8);
	$naziv_kupovne = $row[2];
	echo "<span><strong>Naziv kupovne valute: </strong>$naziv_kupovne</span><br/>";

	$result6 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id= '{$kupujem_valutu}'");
	$row = mysqli_fetch_array($result6);
	$tecajnovi = $row[3];
	echo "<span><strong>Tecaj kupovne valute: </strong>$tecajnovi</span><br/>";

	$pretvorbanova = $pretvorba / $tecajnovi;
	echo "<span><strong>Trenutni iznos kupovne valute: </strong>$pretvorbanova</span><br/>";

	$result20 = mysqli_query($veza, "SELECT * FROM zahtjev WHERE zahtjev_id= '{$id_prihvat}'");
	$row = mysqli_fetch_array($result20);
	$korisnik_id = $row[1];

	$result9 = mysqli_query($veza, "SELECT * FROM sredstva WHERE valuta_id= '{$prodajem_valutu}' AND korisnik_id='{$korisnik_id}'");
	$row = mysqli_fetch_array($result9);
	if (mysqli_num_rows($result9) > 0) {
		$iznos_sredstva_prodaje = $row[3];

		$result21 = mysqli_query($veza, "SELECT * FROM sredstva WHERE valuta_id= '{$kupujem_valutu}' AND korisnik_id='{$korisnik_id}'");
		$row = mysqli_fetch_array($result21);
		if (mysqli_num_rows($result21) > 0) {
			$iznos_sredstva_kup = $row[3];
		}

		if (isset($_POST["submit"])) {
			if ($prihvacen > 0) {
				if ($iznos_sredstva_prodaje > $iznos2) {
					$proba = 1;
					if (mysqli_num_rows($result21) > 0) {
						
						$iznos_sredstva_kup = $row[3];
						$pretvoreni_iznos = $iznos_sredstva_prodaje - $iznos2;
						$zbrojeni_iznos = $pretvorbanova + $iznos_sredstva_kup;
						$iznos_pretvorba = mysqli_query($veza, "UPDATE sredstva SET iznos = '{$pretvoreni_iznos}' WHERE valuta_id= '{$prodajem_valutu}' AND korisnik_id='{$korisnik_id}'");
						$iznos_pretvorba2 = mysqli_query($veza, "UPDATE sredstva SET iznos = '{$zbrojeni_iznos}' WHERE valuta_id= '{$kupujem_valutu}' AND korisnik_id='{$korisnik_id}'");
						$result = mysqli_query($veza, "UPDATE zahtjev SET prihvacen = '$prihvacen' WHERE zahtjev_id= '{$id_prihvat}'");
						echo "<p style='color:green'> <span><strong>Ažurirali ste zahtjev! </strong></span><br/></p>";
						$poruka = "Ažurirali ste zahtjev pod ključem: {$id_prihvat}";
					} else {
						
						$pretvoreni_iznos = $iznos_sredstva_prodaje - $iznos2;
						$iznos_pretvorba3 = mysqli_query($veza, "UPDATE sredstva SET iznos = '{$pretvoreni_iznos}' WHERE valuta_id= '{$prodajem_valutu}' AND korisnik_id='{$korisnik_id}'");
						$iznos_pretvorba4 = mysqli_query($veza, "INSERT INTO sredstva (korisnik_id, valuta_id, iznos) VALUES ('{$korisnik_id}', '{$kupujem_valutu}', '{$pretvorbanova}')");
						$result = mysqli_query($veza, "UPDATE zahtjev SET prihvacen = '$prihvacen' WHERE zahtjev_id= '{$id_prihvat}'");
						echo "<p style='color:green'> <span><strong>Ažurirali ste zahtjev! </strong></span><br/></p>";
						$poruka = "Ažurirali ste zahtjev pod ključem: {$id_prihvat}";
					}
				} else {
					echo "<p style='color:red'> <span><strong>Nemate dovoljno te valute! </strong></span><br/></p>";
				}
			} else {
				echo "<p style='color:red'> <span><strong>Niste azurirali zahtjev! </strong></span><br/></p>";
			}
		}
	} else {
		echo "<p style='color:red'> <span><strong>Nemate tu valutu! </strong></span><br/></p>";
	}
	zatvoriVezuNaBazu($veza);
	?>
</body>

</html>