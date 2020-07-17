<?php

include("baza.php");

$veza = spojiSeNaBazu();
if (session_id() == "") session_start();
$trenutna = basename($_SERVER["PHP_SELF"]);
$putanja = $_SERVER['REQUEST_URI'];
$aktivni_korisnik = 0;
$aktivni_korisnik_tip = -1;
$aktivna_valuta = 6;

if (isset($_SESSION['aktivni_korisnik'])) {
    $aktivni_korisnik = $_SESSION['aktivni_korisnik'];
    $aktivni_korisnik_ime = $_SESSION['aktivni_korisnik_ime'];
    $aktivni_korisnik_tip = $_SESSION['aktivni_korisnik_tip'];
    $aktivni_korisnik_id = $_SESSION['aktivni_korisnik_id'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="autor" content="Josip Kovačević" />
    <meta name="datum" content="4.6.2020." />
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200&display=swap" rel="stylesheet">
    <link href="jkovacevi.css" type="text/css" rel="stylesheet" />
</head>

<body>

    <div class="container">
        <div class="navigation">
            <div class="left-side">
                <div class="nav-link">
                    <?php
                    echo "<strong>Trenutna lokacija: </strong>" . $trenutna . "";
                    ?>
                </div>
                <div class="nav-link">
                    <?php
                    if ($aktivni_korisnik === 0) {
                        echo "<span><strong>Status: </strong>Neprijavljeni korisnik</span>";
                    ?>
                </div>

                <div class="nav-link1">
                    <?php
                        echo "<a class='link' href='prijava.php'>Prijava</a>";
                    ?>
                </div>


                <div class="nav-link">
                <?php
                    } else {
                ?>
                </div>
                <div class="nav-link">
                    <?php
                        echo "<span><strong>Status: </strong>Dobrodošli, $aktivni_korisnik_ime</span>";
                    ?>
                </div>

                <div class="nav-link1">
                    <?php
                        echo "<a class='link' href='prijava.php?logout=1'>Odjava</a>";
                    ?>
                </div>


                <div class="nav-link">
                <?php
                    }
                ?>

                <?php
                switch (true) {
                    case $trenutna:
                        switch ($aktivni_korisnik_tip) {
                            case 0:
                ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="index.php"';
                                if ($trenutna == "index.php");
                                echo "> Početna </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="sredstva.php"';
                                if ($trenutna == "sredstva.php");
                                echo "> Sredstva </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="zahtjevnovi.php"';
                                if ($trenutna == "zahtjevnovi.php");
                                echo "> Novi Zahtjev </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="prihvat2.php"';
                                if ($trenutna == "prihvat2.php");
                                echo "> Moji zahtjevi </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="prihvat.php"';
                                if ($trenutna == "prihvat.php");
                                echo "> Prihvati zahtjev </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="azuriraj_valute_admin.php"';
                                if ($trenutna == "azuriraj_valute_admin.php");
                                echo "> Azuriraj Valutu </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="registracija.php"';
                                if ($trenutna == "registracija.php");
                                echo "> Registracija </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="azuriraj.php"';
                                if ($trenutna == "azuriraj.php");
                                echo "> Azuriraj korisnika </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="dodaj_valutu.php"';
                                if ($trenutna == "dodaj_valutu.php");
                                echo "> Dodaj valutu </a>";
                    ?>
                </div>
                <div class="nav-link">
                    <?php
                                echo '<a href="prikaz.php"';
                                if ($trenutna == "prikaz.php");
                                echo "> Prikazi sumu zahtjeva</a>";
                    ?>
                </div>

                    <div class="nav-link">
                    <?php
                                echo '<a href="prikaz_svega2.php"';
                                if ($trenutna == "prikaz_svega2.php");
                                echo "> Prikazi sumu zahtjeva s vremenom</a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="o_autoru.html"';
                                if ($trenutna == "o_autoru.php");
                                echo "> O autoru </a>";
                    ?>
                </div>


                <div class="nav-link">
                <?php
                                break;
                            case 1:
                                echo '<a href="index.php"';
                                if ($trenutna == "index.php");
                                echo "> Početna </a>";
                ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="sredstva.php"';
                                if ($trenutna == "sredstva.php");
                                echo "> Sredstva </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="zahtjevnovi.php"';
                                if ($trenutna == "zahtjevnovi.php");
                                echo "> Novi Zahtjev </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="prihvat2.php"';
                                if ($trenutna == "prihvat2.php");
                                echo "> Moji zahtjevi </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="prihvat.php"';
                                if ($trenutna == "prihvat.php");
                                echo "> Prihvati zahtjev </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="azuriraj_valute_mod.php"';
                                if ($trenutna == "azuriraj_valute_mod.php");
                                echo "> Azuriraj Tecaj </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="o_autoru.html"';
                                if ($trenutna == "o_autoru.php");
                                echo "> O autoru </a>";
                    ?>
                </div>


                <div class="nav-link">
                <?php

                                break;

                            case 2:
                                echo '<a href="index.php"';
                                if ($trenutna == "index.php");
                                echo "> Početna </a>";
                ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="sredstva.php"';
                                if ($trenutna == "sredstva.php");
                                echo "> Sredstva </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="zahtjevnovi.php"';
                                if ($trenutna == "zahtjevnovi.php");
                                echo "> Novi Zahtjev </a>";
                    ?>
                </div>


                <div class="nav-link">
                    <?php
                                echo '<a href="prihvat2.php"';
                                if ($trenutna == "prihvat2.php");
                                echo "> Moji zahtjevi </a>";
                                echo '<a href="o_autoru.html"';
                                if ($trenutna == "o_autoru.php");
                                echo "> O autoru </a>";
                    ?>
                </div>


                <div class="nav-link">
                <?php
                                break;

                            default:
                                echo '<a href="index.php"';
                                if ($trenutna == "index.php");
                                echo "> Početna </a>";
                ?>
                </div>


                <div class="nav-link">
                    <?php

                                echo '<a href="o_autoru.html"';
                                if ($trenutna == "o_autoru.php");
                                echo "> O autoru </a>";
                    ?>
                </div>


                <div class="nav-link">
    <?php
                                break;
                        }
                }
    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>