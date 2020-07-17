<?php
include("zaglavljeproba.php");
include_once("baza.php");

$veza = spojiSeNaBazu();

$id_azuriranja_korisnika = $_GET["id"];

$upit = "SELECT v.naziv, SUM(z.iznos) as ukupno_prodani_iznos FROM valuta v, zahtjev z WHERE v.valuta_id=z.prodajem_valuta_id AND z.prihvacen=1 AND moderator_id='{$id_azuriranja_korisnika}'
GROUP BY v.valuta_id ORDER BY ukupno_prodani_iznos DESC";
$result = izvrsiUpit($veza, $upit);

$upit2 ="SELECT * FROM korisnik WHERE korisnik_id='{$id_azuriranja_korisnika}'";
$result2 = izvrsiUpit($veza, $upit2);
$ispis = mysqli_fetch_array($result2);




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
    <br>
    <div class="container">
        <div class="naslov">
            <h1>Azuriraj valutu</h1>
        </div>
    </div>
    <div>
        <?php
            echo "Ukupan iznos svih sredstava za moderatora: ";
            echo "{$ispis[4]} ";
            echo "{$ispis[5]}";
        ?>
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