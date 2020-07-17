<?php


include_once("baza.php");


$upit = "SELECT *FROM valuta";
$rezultat = izvrsiUpit($veza, $upit);
zatvoriVezuNaBazu($veza);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Valute</title>
	<meta charset="utf-8">
	<meta name="autor" content="Josip Kovačević">
	<meta name="datum" content="04.06.2020.">
	<link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php
	if (isset($rezultat)) { ?>
		<div class="responsive" style="text-align: center">
			<?php
			while ($row = mysqli_fetch_array($rezultat)) {
				echo "<a href='azuriraj_valute.php?id=" . $row[0] . "'><img src=\"" . $row[4] . "\" width=150 height=90 border=1px margin=6px ></a>";
			}
			?>
		</div>
	<?php
	} ?>
</body>

</html>