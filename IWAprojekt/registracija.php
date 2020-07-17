<?php 
	include("zaglavljeproba.php");
	include_once("baza.php");

	$veza = spojiSeNaBazu();
	$id_novi_korisnik="";
	if(isset($_POST["submit"])){
		$greska = "";
		$poruka = "";
		$ime = $_POST["ime"];
		$prezime = $_POST["prezime"];
		$email = $_POST["email"];
		$korime = $_POST["korime"];
		$lozinka = $_POST["lozinka"];
		
		if(!isset($ime) || empty($ime)){
			$greska .= "Niste unijeli ime! <br>";
		}
		if(!isset($prezime) || empty($prezime)){
			$greska .= "Niste unijeli prezime! <br>";
		}
		if(!isset($email) || empty($email)){
			$greska .= "Niste unijeli email! <br>";
		}
		if(!isset($korime) || empty($korime)){
			$greska .= "Niste unijeli korisničko ime! <br>";
		}
		if(!isset($lozinka) || empty($lozinka)){
			$greska .= "Niste unijeli lozinku! <br>";
		}

		
		if(empty($greska)){
			$poruka = "Kreirali ste račun!";

			$upit = "INSERT INTO korisnik (tip_korisnika_id, ime, prezime, email, korisnicko_ime, lozinka) 
			VALUES (2, '{$ime}', '{$prezime}', '{$email}', '{$korime}', '{$lozinka}')";
			izvrsiUpit($veza, $upit);
			$id_novi_korisnik = mysqli_insert_id($veza);
			$poruka = "Unesen je novi korisnik pod ključem: $id_novi_korisnik";
		}

	$upit = "SELECT *FROM korisnik";
	$rezultat = izvrsiUpit($veza, $upit);

	zatvoriVezuNaBazu($veza);
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Registracija</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovačević">
		<meta name="datum" content="04.06.2020.">
		<link href="jkovacevi.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
 		<br>
		<div class="container">
			<div class="naslov">
				<h1>Prijava </h1>
			</div>
		</div>
		<br>

			<form id="obrazac" name="obrazac" method="post" align="center"
			action="<?php echo $_SERVER["PHP_SELF"];?>"> 
				<br><label for="ime">Ime:</label>
				<input name="ime" type="text" />
				<br>
				<label for="prezime">Prezime:</label>
				<input name="prezime" type="text" />
				<br>
				<label for="email">Email:</label>
				<input name="email" type="email" />
				<br>
				<label for="korime">Korisničko ime:</label>
				<input name="korime" type="text" />
				<br>
				<label for="lozinka">Lozinka:</label>
				<input name="lozinka" type="password" />
				<br>
				<input class="pok" name="submit" type="submit" value="Unesi"/>
				<input id="reset" class="pok" type="reset" name="reset"  
				value="Inicijaliziraj" />
			</form>
		<div>
			<?php 
				if(isset($greska)){
					echo "<p style='color:red'>$greska</p>";
				}
				if(isset($_COOKIE['moj_kolacic'])){
						echo "<p style='color:green'>{$_COOKIE['moj_kolacic']}</p>";
				}
				if(isset($poruka)){
					echo "<p style='color:green'>$poruka</p>";
				}
			?>
		</div>
	 </body>
	</html>