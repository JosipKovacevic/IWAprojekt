<?php 
	include("zaglavljeproba.php");
	include_once("baza.php");
	$veza = spojiSeNaBazu();
	$id_azuriranja_valute = $_GET["id"];

	$result2 = mysqli_query($veza,"SELECT * FROM valuta WHERE valuta_id='{$id_azuriranja_valute}'");
	$row=mysqli_fetch_array($result2);
	$datum=$row[8];
	
	if(isset($_POST["submit"])){
		$greska = "";
		$poruka = "";
		$tecaj = $_POST["tecaj"];
		$date = date("Y-m-d");
		//var_dump($date);
		//var_dump($datum);
		
		
		if(!isset($tecaj) || empty($tecaj)){
			$greska .= "Niste unijeli tecaj! <br>";
		}
		if(!isset($date) || empty($date)){
			$greska .= "Niste unijeli datum! <br>";
		
		}
		
		if(empty($greska)){
			if ($date == $datum){
				echo "<p style='color:red'> <span><strong>Danas ste vec azurirali valutu!</strong></span><br/></p>";
	
			
			}
			else{
				$upit="UPDATE valuta SET tecaj='{$tecaj}',datum_azuriranja='{$date}' WHERE valuta_id='{$id_azuriranja_valute}'";
				izvrsiUpit($veza, $upit);
			
				$poruka = "Ažurirali ste valutu pod ključem: $id_azuriranja_valute";
			}
		}
	}
		
	
	

	$upit = "SELECT *FROM valuta WHERE valuta_id='{$id_azuriranja_valute}'";
	$rezultat = izvrsiUpit($veza, $upit);
	$rezultat_ispis = mysqli_fetch_assoc($rezultat);



	zatvoriVezuNaBazu($veza);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Azuriranje valute</title>
		<meta charset="utf-8">
		<meta name="autor" content="Josip Kovačević">
		<meta name="datum" content="04.06.2020.">
		<link href="jkovacevi.css" rel="stylesheet" type="text/css">
 	</head>
 	<body>
 		<br>
		<div class="container">
			<div class="naslov">
				<h1>Forma za azuriranje valute:</h1>
			</div>
		</div>
		<br>

 		<?php 
			echo "Forma za  azuriranje valute pod ključem: $id_azuriranja_valute";
			echo "<br/><span><strong>Datum azuriranja: </strong>$datum</span><br/>";
		?>
			<form id="obrazac" name="obrazac" method="post" 
			action="<?php echo $_SERVER["PHP_SELF"]."?id={$id_azuriranja_valute}";?>">
				<label for="tecaj">Tecaj:</label>
				<input name="tecaj" type="text" 
				value="<?php echo $rezultat_ispis["tecaj"];?>";
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