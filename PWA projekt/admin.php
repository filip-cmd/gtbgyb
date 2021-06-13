  <?php
session_start();
define('UPLPATH', 'img/');
include 'connect.php';
$uspjesnaPrijava = NULL;

if (isset($_POST['posalji2'])) {
    $prijavaImeKorisnika = $_POST['korisnicko'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    

    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt);

    if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;
    }

    if ($levelKorisnika == 1) {
        $admin = true;
    } else {
        $admin = false;
    }

    $_SESSION['$username'] = $imeKorisnika;
    $_SESSION['$level'] = $levelKorisnika;
} else {
    $uspjesnaPrijava = false;
}

?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="administracija.css" />
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
<?php
if (($uspjesnaPrijava == true && $admin == true) ||
        (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1
    ) {

if(isset($_POST['delete'])){ $id=$_POST['id'];
 $query = "DELETE FROM clanak WHERE id=$id ";
 $result = mysqli_query($dbc, $query); }

if(isset($_POST['update']))
    { $picture = $_FILES['Slika']['name'];
     $title=$_POST['title'];
      $about=$_POST['about'];
       $content=$_POST['content'];
        $category=$_POST['category'];
         if(isset($_POST['archive'])){ $archive=1; }
         else{ $archive=0; }
          $target_dir = 'img/'.$picture;
          $id=$_POST['id'];
          $query = "UPDATE clanak SET Naslov='$title', Sazetak='$about', Tekst='$content', Slika='$picture', Kategorija='$category', Arhiva='$archive' WHERE id=$id ";
          move_uploaded_file($_FILES["Slika"]["tmp_name"], $target_dir);
           $result = mysqli_query($dbc, $query); }

$query = "SELECT * FROM clanak";
$result = mysqli_query($dbc, $query);
 while($row = mysqli_fetch_array($result)) {
  echo '<form enctype="multipart/form-data" action="" method="POST">
   <div class="form-item">
    <label for="title">Naslov vjesti:</label>
     <div class="form-field">
      <input type="text" name="title" class="form-field-textual" value="'.$row['Naslov'].'">
       </div> </div> 
       <div class="form-item">
        <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
         <div class="form-field">
          <textarea name="about" id="" cols="30" rows="10" class="form-field-textual">
          '.$row['Sazetak'].'</textarea>
           </div> </div> 
           <div class="form-item">
            <label for="content">Sadržaj vijesti:</label> 
            <div class="form-field">
             <textarea name="content" id="" cols="30" rows="10" class="form-field-textual">'.$row['Tekst'].'</textarea>
              </div> </div>
               <div class="form-item"> 
               <label for="Slika">Slika:</label>
                <div class="form-field">
<input type="file" class="slika" id="slika" value="'.$row['Slika'].'" name="Slika"/>
 <br>
 <img src="' . UPLPATH . $row['Slika'] . '" width=100px>
 </div> </div>
   <div class="form-item">
    <label for="category">Kategorija vijesti:</label>
     <div class="form-field"> <select name="category" id="" class="form-field-textual" value="'.$row['Kategorija'].'">
      <option value="Politika">Politika</option>
       <option value="IT">IT</option>
       <option value="Zabava">Zabava</option> 
       </select>
        </div> </div>
         <div class="form-item">
          <label>Spremiti u arhivu: <div class="form-field">'; 
          if($row['Arhiva'] == 0) { 
            echo '<input type="checkbox" name="archive" id="archive"/> Arhiviraj?'; } else {
             echo '<input type="checkbox" name="archive" id="archive" checked/> Arhiviraj?'; }
              echo '</div> </label> </div> </div>
               <div class="gumbi">
                <input type="hidden" name="id" class="form-field-textual" value="'.$row['id'].'">
                 <button type="reset" value="Poništi">Poništi
                 </button>
                  <button type="submit" name="update"value="Prihvati">Izmjeni</button>
                  <button type="submit" name="delete"value="Izbriši">Izbriši</button> </div> </form>'; }
                }
                else if ($uspjesnaPrijava == true && $admin == false) {
        echo 'Bok' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.';
    } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
        echo 'Bok' . $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste admin';
    } else if ($uspjesnaPrijava == false) {
        $msg = '';
        echo '<div class="wrapper gornji" style="margin-top:15px; margin-bottom:130px;">
                <div>
                    <form name="forma" class="forma" action="" method="POST">
                        <div>
                            <label for="korisnicko">Korisnicko  ime:</label><br>
                            <input id="korisnicko" type="text" name="korisnicko">
                            <br><span class="error" id="porukaIme"><br>
                        </div>
                        <div>
                            <label for="lozinka">Lozinka:</label><br>
                            <input type="password" name="lozinka" id="lozinka">
                            <br><span class="error" id="porukaPrezime"><br>
                        </div>
                        <div>
                            <button type="reset" value="ponisti">Poništi</button>
                            <button id="gumb2" name="posalji2" type="submit" value="prihvati2">Prihvati</button>
                        </div>
                    </form>
                </div>
            </div>
            
                
            </div>
        </div>
    </main>';}
                  
?>


</div>
        <footer>
            <p>Copyright Filip Rostohar</p>
        </footer>

  
  </body>
  </html>