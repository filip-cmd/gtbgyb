<?php
include 'connect.php';

if (isset($_POST['Arhiva'])) { $kvacica=1; }
else {$kvacica=0;}
$naslov=$_POST['Naslov'];
$sazetak=$_POST['Sazetak'];
$vijest=$_POST['Vijest'];
$kategorija=$_POST['Kategorija'];
$slika = $_FILES['Slika']['name'];
$datum=date("Y-m-d");

$target = 'img/'.$slika;

$query = "INSERT INTO clanak (Naslov, Sazetak, Tekst ,Kategorija , Slika, Arhiva, Datum ) VALUES ('$naslov', '$sazetak', '$vijest' , '$kategorija', '$slika', '$kvacica', '$datum')";

move_uploaded_file($_FILES['Slika']['tmp_name'], $target);

$result = mysqli_query($dbc, $query) or die('Error querying databese.');
mysqli_close($dbc);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="clanak.css" />
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
			define('UPLPATH', 'img/');
			include 'connect.php';
			$query = "SELECT * FROM clanak ORDER BY  id DESC LIMIT 1";
			 $result = mysqli_query($dbc, $query);
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