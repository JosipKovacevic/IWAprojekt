<?php

include_once("baza.php");

$veza = spojiSeNaBazu();
$sredstva_id = "";
if (isset($_POST["submit"])) {
    $greska = "";
    $poruka = "";

    $korisnik_id = $aktivni_korisnik_id;
    $valuta_id = $_POST["valuta_id"];
    $iznos = $_POST["iznos"];


    if (!isset($valuta_id) || empty($valuta_id)) {
        $greska .= "Niste unijeli valutu! <br>";
    }
    if (!isset($iznos) || empty($iznos)) {
        $greska .= "Niste unijeli iznos! <br>";
    }

    if (empty($greska)) {
        

        $result21 = mysqli_query($veza, "SELECT * FROM sredstva WHERE valuta_id= '{$valuta_id}' AND korisnik_id='{$korisnik_id}'");
        $row = mysqli_fetch_array($result21);
        if (mysqli_num_rows($result21) > 0) {
            $greska = "Imate tu valutu!";
            
            
        }else{

        $upit = "INSERT INTO sredstva (korisnik_id, valuta_id, iznos) 
			VALUES ('{$korisnik_id}','{$valuta_id}', '{$iznos}')";
        izvrsiUpit($veza, $upit);
        $sredstva_id = mysqli_insert_id($veza);
        $poruka = "Dodali ste sredstva!";
    }
}
}
$upit1 = "SELECT * FROM valuta";
$rezultat1 = izvrsiUpit($veza, $upit1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dodaj Sredstva</title>
    <meta charset="utf-8">
    <meta name="autor" content="Josip Kovačević">
    <meta name="datum" content="04.06.2020.">
    <link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
    <br>
    <div class="container">
        <div class="naslov">
            <h1>Forma za dodavanje novog sredstva: </h1>
        </div>
    </div>
    <br>

    <form id="obrazac" name="obrazac" method="post" align="center" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <label for="valuta_id">Valuta :</label>
        
		<select name="valuta_id">
			<?php
			while ($red = mysqli_fetch_array($rezultat1)) {
				echo "<option value='{$red["valuta_id"]}'";

				echo ">{$red["naziv"]}</option>";
			}
			?>
		</select>
		<br>
        <br>
        <label for="iznos">Iznos:</label>
        <input name="iznos" type="float" />
        <br>
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