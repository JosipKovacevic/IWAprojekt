<?php
include("zaglavljeproba.php");
include_once("baza.php");

$veza = spojiSeNaBazu();
$id_nova_valuta = "";
if (isset($_POST["submit"])) {
	$greska = "";
	$poruka = "";
	$moderator_id = $_POST["moderator_id"];
	$naziv = $_POST["naziv"];
	$tecaj = $_POST["tecaj"];
	$aktivno_od = $_POST["aktivno_od"];
	$aktivno_do = $_POST["aktivno_do"];
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
		$poruka = "Kreirali ste račun!";

		$upit = "INSERT INTO valuta (moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja) 
			VALUES ('{$moderator_id}', '{$naziv}', '{$tecaj}', '{$slika}', '{$zvuk}','{$aktivno_od}', '{$aktivno_do}', '{$date}')";
		izvrsiUpit($veza, $upit);
		$id_nova_valuta = mysqli_insert_id($veza);
		$poruka = "Unesena je nova valuta!";
	}


	
}
$upit1 = "SELECT * FROM korisnik WHERE tip_korisnika_id = 1";
$rezultat1 = izvrsiUpit($veza, $upit1);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Dodaj valutu</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
	<br>
	<div class="container">
		<div class="naslov">
			<h1>Forma za dodavanje nove valute: </h1>
		</div>
	</div>
	<br>

	<form id="obrazac" name="obrazac" method="post" align="center" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<br><label for="moderator_id">Moderator ID:</label>
		<select name="moderator_id">
			<?php
			while ($red = mysqli_fetch_array($rezultat1)) {
				echo "<option value='{$red["korisnik_id"]}'";
				
					echo " selected='selected' ";
				
				echo ">{$red["ime"]} " . " {$red["prezime"]}</option>";
			}
			
			?>
		</select>
		
		<br>
		<label for="naziv">Naziv:</label>
		<input name="naziv" type="text" />
		<br>
		<label for="tecaj">tecaj:</label>
		<input name="tecaj" type="float" />
		<br>
		<label for="slika">Slika:</label>
		<input name="slika" type="text" />
		<br>
		<label for="zvuk">Zvuk:</label>
		<input name="zvuk" type="text" />
		<br>
		<label for="aktivno_od">Aktivno od:</label>
		<input name="aktivno_od" type="text" value="hh:mm" />
		<br>
		<label for="aktivno_do">aktivno_do:</label>
		<input name="aktivno_do" type="text" value="hh:mm" />
		<br>
		<input class="pok" name="submit" type="submit" value="Unesi" />
		<input id="reset" class="pok" type="reset" name="reset" value="Inicijaliziraj" />
	</form>
	<div>
		<?php
		if (isset($greska)) {
			echo "<p style='color:red'>$greska</p>";
		}
		if (isset($_COOKIE['moj_kolacic'])) {
			echo "<p style='color:green'>{$_COOKIE['moj_kolacic']}</p>";
		}
		if (isset($poruka)) {
			echo "<p style='color:green'>$poruka</p>";
		}
		?>
	</div>
</body>

</html>