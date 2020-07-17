<?php
include("zaglavljeproba.php");
include_once("baza.php");
$veza = spojiSeNaBazu();
$id_promijeni_iznos = $_GET["id"];
if (isset($_POST["submit"])) {
	$iznos = $_POST["iznos"];
	$greska = "";
	$poruka = "";
	if (!isset($iznos) || empty($iznos)) {
		$greska .= "Niste unijeli Iznos! <br>";
	}
	if (empty($greska)) {
		$upit = "UPDATE sredstva SET 
			iznos='{$iznos}'
			WHERE sredstva_id='{$id_promijeni_iznos}'";
		izvrsiUpit($veza, $upit);
		$poruka = "Ažurirali ste iznos pod ključem: $id_promijeni_iznos";
	}
}

$upit = "SELECT *FROM sredstva WHERE sredstva_id='{$id_promijeni_iznos}'";
$rezultat = izvrsiUpit($veza, $upit);
$rezultat_ispis = mysqli_fetch_assoc($rezultat);

zatvoriVezuNaBazu($veza);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Promijeni iznos</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
	<h2 style="margin-top:0px;">Forma za promijenu iznosa sredstva:</h2>
	<?php
	echo "Forma za promijenu iznosa sredstva pod ključem: $id_promijeni_iznos";
	?>
	<form id="obrazac" name="obrazac" method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id={$id_promijeni_iznos}"; ?>">
		<label for="iznos">Iznos:</label>
		<input name="iznos" type="text" value="<?php echo $rezultat_ispis["iznos"]; ?>" ; />
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