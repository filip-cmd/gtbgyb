<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" type="text/css" href="style3.css" />
<script type="text/javascript" src="jquery-1.11.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="java.js"></script> 
</head>
<body>
	<header>
			  <nav class="navigacija">
                <img class="prvi" src="mopo-logo.png" style="height: 50px; width: 100px; margin-right: 0;">
                <a href="index.php">HOME</a>
                <a href="forma.php">Forma</a> 
                <a href="kategorija_politika.php">Politika</a> 
                <a href="kategorija_IT.php">IT</a> 
                <a href="kategorija_Zabava.php">Zabava</a>
                <a href="admin.php">Administracija</a>
                <a href="registracija.php">Registracija</a>   
            </nav>
			<div class="container">
				<form action="skripta.php" method="POST" enctype="multipart/form-data" id="izrada">
					<label for="Naslov">Unesi naslov</label>

     	  			<input type="text" name="Naslov" id="Naslov"/>

     	  			<label for="Sazetak">Sazetak vijest</label>

     	  			<textarea name="Sazetak" id="Sazetak" rows="5"></textarea>

     	  			<label for="Vijest">Unesite tekst vijesti</label>

     	  			<textarea name="Vijest" id="Vijest" rows="10"></textarea>

     	  			<label for="Kategorija">Odaberite kategoriju</label>

     	  			<input list="Kategorije" name="Kategorija">
					  	<datalist id="Kategorije">
					    <option value="Politika">
					    <option value="IT">
					    <option value="Zabava">
					  	</datalist>

					<label for="Slika">Slika</label>

     	  			<input type="file" accept="image/jpg,image/gif" class="slika" name="Slika"/>
     	  			<br>
     	  			<label for="Arhiva">Spremiti u arhivu</label>
     	  			<input type="checkbox" name="Arhiva">

     	  			<button type="submit" value="Prihvati">Prihvati</button>
     	  			<button type="reset" value="Poništi">Poništi</button>
     	  			
				</form>
			</div>
		</header>
		<footer>
			<p>Copyright Filip Rostohar</p>
		</footer>

</body>
</html>