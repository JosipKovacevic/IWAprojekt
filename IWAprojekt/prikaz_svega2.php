<?php
include("zaglavljeproba.php");
include_once("baza.php");

$veza = spojiSeNaBazu();

if (isset($_GET["submit"])) {
    $moderator_id = $_GET["korisnik_id"];
    $aktivno_od = $_GET["aktivno_od"];
    $aktivno_do = $_GET["aktivno_do"];
    $greska = "";
	$poruka = "";

    if(!isset($moderator_id) || empty($moderator_id)){
        $greska .= "Niste unijeli moderatora! <br>";
    }
    if(!isset($aktivno_od) || empty($aktivno_od)){
        $greska .= "Niste unijeli Aktivno od! <br>";
    }
    
    if(!isset($aktivno_do) || empty($aktivno_do)){
        $greska .= "Niste unijeli Aktivno do! <br>";
    }
    if(empty($greska)){
        $upit = "SELECT v.naziv, SUM(z.iznos) as ukupno_prodani_iznos FROM valuta v, zahtjev z 
        WHERE v.valuta_id=z.prodajem_valuta_id AND z.prihvacen=1 AND moderator_id='{$moderator_id}' 
        AND datum_vrijeme_kreiranja BETWEEN '{$aktivno_od}' AND '{$aktivno_do}'
        GROUP BY v.valuta_id ORDER BY ukupno_prodani_iznos DESC";
        $result = izvrsiUpit($veza, $upit);
    }else{
        echo $greska;
    }
}
    
$upit2 = "SELECT * FROM korisnik WHERE tip_korisnika_id=1";
$result2 = izvrsiUpit($veza, $upit2);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Azuriraj valutu</title>
    <meta charset="utf-8">
    <meta name="autor" content="Josip Kovačević">
    <meta name="datum" content="04.06.2020.">
    <link href="jkovacevi.css" rel="stylesheet" type="text/css">
</head>

<body>
    <form id="obrazac" name="obrazac" method="get" align="center" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <label for="korisnik_id">Valuta :</label>

        <select name="korisnik_id">
            <?php
            while ($red = mysqli_fetch_array($result2)) {
                echo "<option value='{$red["korisnik_id"]}'";
                
                echo ">{$red["ime"]}</option>";
                $moderator_id = $red["korisnik_id"];
            }
            ?>
        </select>
        <label for="aktivno_od">Aktivno od:</label>
        <input name="aktivno_od" type="date"  />
        <br>
        <label for="aktivno_do">Aktivno do:</label>
        <input name="aktivno_do" type="date"  />
        <br>

        <input id="submit" class="pok" name="submit" type="submit" value="Unesi" />
        <input id="reset" class="pok" type="reset" name="reset" value="Inicijaliziraj" />
    </form>
    <br>
    <div class="container">
        <div class="naslov">
            <h1>Azuriraj valutu</h1>
        </div>
    </div>
    <div>
    <form id="obrazac" name="obrazac" method="get" align="center" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

<label for="korisnik_id">Valuta :</label>

<select name="korisnik_id">
    <?php
    while ($red = mysqli_fetch_array($result2)) {
        echo "<option value='{$red["korisnik_id"]}'";
        
        echo ">{$red["ime"]}</option>";
        $moderator_id = $red["korisnik_id"];
    }
    ?>
</select>
<label for="aktivno_od">Aktivno od:</label>
<input name="aktivno_od" type="date"  />
<br>
<label for="aktivno_do">Aktivno do:</label>
<input name="aktivno_do" type="date"  />
<br>

<input id="submit" class="pok" name="submit" type="submit" value="Unesi" />
<input id="reset" class="pok" type="reset" name="reset" value="Inicijaliziraj" />
</form>
<br>
    </div>
    <br>
    <table class="tablica">
        <thead>
            <tr>
                <th>Naziv valute</th>
                <th>Ukupni iznos</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result)) {
                while ($red = mysqli_fetch_array($result)) {

                    echo "<tr>";
                    echo "<td>{$red[0]}</td>";
                    echo "<td>{$red[1]}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>