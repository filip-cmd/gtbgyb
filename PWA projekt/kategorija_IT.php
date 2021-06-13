<?php include 'connect.php';
 define('UPLPATH', 'img/');
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<meta charset="utf-8">
  	<title></title>
  	<link rel="stylesheet" type="text/css" href="index.css" />
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
			<hr class="navi">
		</header>
		<div class="container">
		<div class="clanci">
			<section class="IT">
			<h1>IT</h1>
			<hr>
			<?php
			$query = "SELECT * FROM clanak WHERE arhiva=1 AND kategorija='IT'";
			 $result = mysqli_query($dbc, $query);
			 $i=0; 
			 while($row = mysqli_fetch_array($result))
			  	{
			  	 echo '<article>';
			  	 echo'<div class="article">';
			  	 echo '<div class="Politika_img">';
			  	 echo '<img src="' . UPLPATH . $row['Slika'] . '">'; 
			  	 echo '</div>';
			  	 echo '<div class="media_body">'; 
			  	 echo '<h4 class="title">'; 
			  	 echo '<a href="clanak.php?id='.$row['id'].'">'; 
			  	 echo $row['Naslov']; 
			  	 echo '</a></h4>'; 
			  	 echo '</div></div>'; 
			  	 echo '</article>';  }


			  	?>
			  	 </section>

		</div>
	</div>
		<footer>
			<p>Copyright Filip Rostohar</p>
		</footer>

  
  </body>
  </html>