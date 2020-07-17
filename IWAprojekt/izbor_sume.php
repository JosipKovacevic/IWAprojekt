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
            