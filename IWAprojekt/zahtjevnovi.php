<?php
include("zaglavljeproba.php");
include_once("baza.php");

$veza = spojiSeNaBazu();
$id_novi_zahtjev = "";

$date = date("Y-m-d h:i:s");
if (isset($_POST["submit"])) {
	$greska = "";
	$poruka = "";
	$iznos = $_POST["iznos"];
	$kupujem_valuta_id = $_POST["valuta_id"];
	$prodajem_valuta_id = $_POST["valuta_id1"];

	if (!isset($iznos) || empty($iznos)) {
		$greska .= "Niste unijeli iznos! <br>";
	}
	if (!isset($kupujem_valuta_id) || empty($kupujem_valuta_id)) {
		$greska .= "Niste unijeli valutu! <br>";
	}

	if (empty($greska)) {
		$poruka = "Kreirali ste zahtjev!";

		$upit = "INSERT INTO zahtjev (korisnik_id, iznos, prodajem_valuta_id, kupujem_valuta_id, datum_vrijeme_kreiranja, prihvacen) 
			VALUES ('$aktivni_korisnik_id', '{$iznos}', '$kupujem_valuta_id', '$prodajem_valuta_id', '$date', 0)";

		izvrsiUpit($veza, $upit);
		$id_novi_zahtjev = mysqli_insert_id($veza);
		$poruka = "Unesen je novi zahtjev pod ključem: $id_novi_zahtjev";
	}
}

$upit = "SELECT *FROM zahtjev";
$rezultat = izvrsiUpit($veza, $upit);

$upit1 = "SELECT * FROM valuta";
$rezultat1 = izvrsiUpit($veza, $upit1);


$upit2 = "SELECT * FROM valuta";
$rezultati = izvrsiUpit($veza, $upit2);


zatvoriVezuNaBazu($veza);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Novi zahtjev</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
	<br>
	<div class="container">
		<div class="naslov">
			<h1>Forma za dodavanje novog zahtjeva:</h1>
		</div>
	</div>
	<br>

	<form id="obrazac" name="obrazac" method="post" align="center" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<br>
		<label for="iznos">iznos:</label>
		<input name="iznos" type="text" />
		<br>
		<label for="valuta_id">Prodajem Valutu:</label>
		<select name="valuta_id">
			<?php
			while ($red = mysqli_fetch_array($rezultat1)) {
				echo "<option value='{$red["valuta_id"]}'";

				echo ">{$red["naziv"]}</option>";
			}
			?>
		</select>
		<br>
		<label for="valuta_id1">Kupujem valutu :</label>
		<select name="valuta_id1">
			<?php
			while ($red = mysqli_fetch_array($rezultati)) {
				echo "<option value='{$red["valuta_id"]}'";

				echo ">{$red["naziv"]}</option>";
			}
			?>
		</select>
		<br>

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
</body>

</html>