<?php 
	include("zaglavljeproba.php");
	include_once("baza.php");
	$veza = spojiSeNaBazu();
	$id_azuriranja_korisnika = $_GET["id"];
	if(isset($_POST["submit"])){
		$greska = "";
		$poruka = "";
		$ime = $_POST["ime"];
		$prezime = $_POST["prezime"];
		$email = $_POST["email"];
		$korime = $_POST["korime"];
		$lozinka = $_POST["lozinka"];
		$tip_korisnika_id = $_POST["tip_korisnika_id"];
		$slika = $_POST["slika"];
		
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
		if(!isset($slika) || empty($slika)){
			$greska .= "Niste unijeli sliku! <br>";
		}

		
		if(empty($greska)){
	
			$upit="UPDATE korisnik SET 
			tip_korisnika_id='{$tip_korisnika_id}',
			ime='{$ime}',
			prezime='{$prezime}',
			email='{$email}',
			korisnicko_ime='{$korime}',
			lozinka='{$lozinka}' ,
			slika='{$slika}'
			WHERE korisnik_id='{$id_azuriranja_korisnika}'";
			izvrsiUpit($veza, $upit);
			
			$poruka = "Ažurirali ste korisnika pod ključem: $id_azuriranja_korisnika";
		}
	}
		
	
	

	$upit = "SELECT *FROM korisnik WHERE korisnik_id='{$id_azuriranja_korisnika}'";
	$rezultat = izvrsiUpit($veza, $upit);
	$rezultat_ispis = mysqli_fetch_assoc($rezultat);

	$upit = "SELECT *FROM tip_korisnika";
	$rezultat_tipovi = izvrsiUpit($veza, $upit);


	zatvoriVezuNaBazu($veza);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Virtualna mjenjačnica</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovačević">
		<meta name="datum" content="04.06.2020.">
		<link href="jkovacevi.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
 		<br>
		<div class="container">
			<div class="naslov">
				<h1>Forma za registraciju novog korisnika:</h1>
			</div>
		</div>
		<br>

 		<?php 
			echo "Forma za ažuriranje korisnika pod ključem: $id_azuriranja_korisnika";
		?>
			<form id="obrazac" name="obrazac" method="post" 
			action="<?php echo $_SERVER["PHP_SELF"]."?id={$id_azuriranja_korisnika}";?>">
				<label for="tip_korisnika_id">Tip korisnika ID:</label>
				<select name="tip_korisnika_id">
					<?php
						while($red = mysqli_fetch_array($rezultat_tipovi)){
							echo "<option value='{$red["tip_korisnika_id"]}'";
							if($rezultat_ispis["tip_korisnika_id"] == $red["tip_korisnika_id"]){
								echo " selected='selected' ";
							}
							echo ">{$red["naziv"]}</option>";
						}
					?>
				</select>
				<br>
				<label for="ime">Ime:</label>
				<input name="ime" type="text" 
				value="<?php echo $rezultat_ispis["ime"];?>";
				/>
				<br>
				<label for="prezime">Prezime:</label>
				<input name="prezime" type="text" 
				value="<?php echo $rezultat_ispis["prezime"];?>";
				/>
				<br>
				<label for="email">Email:</label>
				<input name="email" type="email" 
				value="<?php echo $rezultat_ispis["email"];?>";
				/>
				<br>
				<label for="korime">Korisničko ime:</label>
				<input name="korime" type="text" 
				value="<?php echo $rezultat_ispis["korisnicko_ime"];?>";
				/>
				<br>
				<label for="lozinka">Lozinka:</label>
				<input name="lozinka" type="password" 
				value="<?php echo $rezultat_ispis["lozinka"];?>";
				/>
				<br>
				<label for="slika">Slika:</label>
				<input name="slika" type="img" 
				value="<?php echo $rezultat_ispis["slika"];?>";
				/>
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
					if(isset($poruka)){
						echo "<p style='color:green'>$poruka</p>";
					}
				?>
			</div>
		</body>
	</html>