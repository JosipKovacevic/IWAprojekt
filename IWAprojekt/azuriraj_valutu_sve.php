<?php
include("zaglavljeproba.php");
include_once("baza.php");
$veza = spojiSeNaBazu();
$id_azuriranja_valute = $_GET["id"];

$result2 = mysqli_query($veza, "SELECT * FROM valuta WHERE valuta_id='{$id_azuriranja_valute}'");
$row = mysqli_fetch_array($result2);
$datum = $row[8];

if (isset($_POST["submit"])) {
	$greska = "";
	$poruka = "";
	$moderator_id = $_POST["moderator_id"];
	$naziv = $_POST["naziv"];
	$tecaj = $_POST["tecaj"];
	$aktivno_od = $_POST["aktivno_od"];
	$vrijeme22 = strtotime($aktivno_od); 
	$pravo_vrijeme1 =  date("H:i:s", $vrijeme22);
	$aktivno_do = $_POST["aktivno_do"];
	$vrijeme33 = strtotime($aktivno_do); 
	$pravo_vrijeme2 =  date("H:i:s", $vrijeme33);
	$date = date("Y-m-d");
	$slika = $_POST["slika"];
	$zvuk = $_POST["zvuk"];

	if (!isset($moderator_id) || empty($moderator_id)) {
		$greska .= "Niste unijeli Moderatora! <br>";
	}
	if (!isset($naziv) || empty($naziv)) {
		$greska .= "Niste unijeli naziv valute! <br>";
	}
	if (!isset($tecaj) || empty($tecaj)) {
		$greska .= "Niste unijeli tecaj! <br>";
	}
	if (!isset($aktivno_od) || empty($aktivno_od)) {
		$greska .= "Niste unijeli aktivno od! <br>";
	}
	if (!isset($aktivno_do) || empty($aktivno_do)) {
		$greska .= "Niste unijeli aktivno do! <br>";
	}
	if (!isset($slika) || empty($slika)) {
		$greska .= "Niste unijeli sliku! <br>";
	}
	if (!isset($zvuk) || empty($zvuk)) {
		$greska .= "Niste unijeli Zvuk! <br>";
	}

	if (empty($greska)) {
		if ($date == $datum) {
			echo "<p style='color:red'> <span><strong>Danas ste vec azurirali valutu!</strong></span><br/></p>";
		} else {
			$upit = "UPDATE valuta SET tecaj='{$tecaj}', datum_azuriranja='{$date}', moderator_id='{$moderator_id}', naziv='{$naziv}', aktivno_od='{$pravo_vrijeme1}',
                 aktivno_do='{$pravo_vrijeme2}', slika='{$slika}', zvuk='{$zvuk}' WHERE valuta_id='{$id_azuriranja_valute}'";
			izvrsiUpit($veza, $upit);

			$poruka = "Ažurirali ste valutu pod ključem: $id_azuriranja_valute";
		}
	}
}




$upit = "SELECT *FROM valuta WHERE valuta_id='{$id_azuriranja_valute}'";
$rezultat = izvrsiUpit($veza, $upit);
$rezultat_ispis = mysqli_fetch_assoc($rezultat);


$upit2 = "SELECT * FROM korisnik ";
$rezultat2 = izvrsiUpit($veza, $upit2);

$upit1 = "SELECT * FROM korisnik WHERE tip_korisnika_id = 1";
$rezultat1 = izvrsiUpit($veza, $upit1);
//$rezultat_ispis1 = mysqli_fetch_array($rezultat1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Azuriranje valute</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
	<br>
	<div class="container">
		<div class="naslov">
			<h1>Forma za azuriranje valute:</h1>
		</div>
	</div>
	<br>

	<?php
	echo "Forma za  azuriranje valute pod ključem: $id_azuriranja_valute";
	echo "<br/><span>Datum zadnjeg azuriranja: $datum</span><br/>";
	?>
	<form id="obrazac" name="obrazac" method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id={$id_azuriranja_valute}"; ?>">
		<label for="tecaj">Tecaj:</label>
		<input name="tecaj" type="text" value="<?php echo $rezultat_ispis["tecaj"]; ?>" ; />
		<br>
		<br><label for="moderator_id">Moderator:</label>
		<select name="moderator_id">
			<?php
			while ($red = mysqli_fetch_array($rezultat1)) {
				echo "<option value='{$red["korisnik_id"]}'";
				//if ($rezultat_ispis1["korisnik_id"] == $red["korisnik_id"]) {
				//	echo " selected='selected' ";
				//}
				echo ">{$red["ime"]} " . " {$red["prezime"]}</option>";
			}
			
			?>
		</select>

		<br>
		<label for="naziv">Naziv:</label>
		<input name="naziv" type="text" value="<?php echo $rezultat_ispis["naziv"]; ?>" ; />
		<br>
		<label for="slika">Slika:</label>
		<input name="slika" type="text" value="<?php echo $rezultat_ispis["slika"]; ?>" ; />
		<br>
		<label for="zvuk">Zvuk:</label>
		<input name="zvuk" type="text" value="<?php echo $rezultat_ispis["zvuk"]; ?>" ; />
		<br>
		<label for="aktivno_od">Aktivno od:</label>
		<input name="aktivno_od" type="text" value="<?php echo $rezultat_ispis["aktivno_od"]; ?>" ; />
		<br>
		<label for="aktivno_do">aktivno_do:</label>
		<input name="aktivno_do" type="text" value="<?php echo $rezultat_ispis["aktivno_do"]; ?>" ; />
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