<?php 
	include("zaglavljeproba.php");
	include_once("baza.php");

	$bp = spojiSeNaBazu();
	
	if(isset($_GET['logout'])){
		unset($_SESSION["aktivni_korisnik"]);
		unset($_SESSION['aktivni_korisnik_ime']);
		unset($_SESSION["aktivni_korisnik_tip"]);
		unset($_SESSION["aktivni_korisnik_id"]);
		session_destroy();
		header("Location:index.php");
	}

	$greska= "";
	if(isset($_POST['submit'])){

		$kor_ime=mysqli_real_escape_string($bp,$_POST['korisnicko_ime']);
		$lozinka=mysqli_real_escape_string($bp,$_POST['lozinka']);	
		if(!empty($kor_ime)&&!empty($lozinka)){
			$sql="SELECT korisnik_id,tip_korisnika_id,ime,prezime FROM korisnik WHERE korisnicko_ime='$kor_ime' AND lozinka='$lozinka'";
			$rs=izvrsiUpit($bp,$sql);
			if(mysqli_num_rows($rs)==0)$greska="Ne postoji korisnik s navedenim korisničkim imenom i lozinkom";
			else{
				list($id,$tip,$ime,$prezime)=mysqli_fetch_array($rs);
				$_SESSION['aktivni_korisnik']=$kor_ime;
				$_SESSION['aktivni_korisnik_ime']=$ime." ".$prezime;
				$_SESSION["aktivni_korisnik_id"]=$id;
				$_SESSION['aktivni_korisnik_tip']=$tip;
				header("Location:index.php");
			}
		}
		else $greska = "Molim unesite korisničko ime i lozinku";
	}
	zatvoriVezuNaBazu($bp);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Prijava</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovacevic">
		<meta name="datum" content="23.05.2020.">
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
		
		<section id="sadrzaj">

			<form id="obrazac" name="obrazac" method="post" align="center" 
			action="<?php echo $_SERVER["PHP_SELF"];?>"> 
				<label for="korisnicko_ime">Korisničko ime:<label>
				<input name="korisnicko_ime" type="text" />
				<br>
				<label for="lozinka">Lozinka:<label>
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
				?>
			</div>
		</section>
	</body>
</html>