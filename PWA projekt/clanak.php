<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style2.css" />
</head>
	<body>
		<div class="container">
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
		</header>
		<hr class="jedan">
		<hr class="dva">
		<section class="clanak">
			<?php
			$id=$_GET['id'];
			define('UPLPATH', 'img/');
			include 'connect.php';
			$query = "SELECT * FROM clanak WHERE id=$id";
			 $result = mysqli_query($dbc, $query);
			 $i=0; 
			 while($row = mysqli_fetch_array($result))
			  	{
			  	 echo '<article>';
			  	 echo'<div class="article">';
			  	 echo '<h4 class="title">';  
			  	 echo $row['Naslov'];
			  	 echo '</h4>';
			  	 echo '<p class="date">';  
			  	 echo $row['Datum'];
			  	 echo '</p>';
			  	 echo '<div class="_img">';
			  	 echo '<img src="' . UPLPATH . $row['Slika'] . '">'; 
			  	 echo '</div>';
			  	 echo '<p>';  
			  	 echo $row['Sazetak'];
			  	 echo '</p><br><br>'; 
			  	 echo '<p class="zadnji">';  
			  	 echo $row['Tekst'];
			  	 echo '</p>'; 
			  	 echo '<hr class="tri">';
			  	 echo '<hr class="cet">';
			  	 echo '</div>'; 
			  	 echo '</article>';  }


			  	?>
			  	 </section>
		<footer>
			<p>Copyright Filip Rostohar</p>
		</footer>
	</div>
	</body>
</html>