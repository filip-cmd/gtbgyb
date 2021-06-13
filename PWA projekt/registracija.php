<?php
session_start();
define('UPLPATH', 'img/');
include 'connect.php';


$ime = $_POST['ime'] ?? "";
$prezime = $_POST['prezime'] ?? "";
$korisnicko = $_POST['korisnicko'] ?? "";
$lozinka = $_POST['lozinka'] ?? "";
$lozinka1 = $_POST['lozinka1'] ?? "";
$razina = $_POST['razina'] ?? "";
$registriranKorisnik = '';
$lozinka_hash = password_hash($lozinka, CRYPT_BLOWFISH);
$msg = "";
if ($razina == 'nula') {
    $razina = 0;
} elseif ($razina == 'jedan') {
    $razina = 1;
}

if (isset($_POST['posalji2'])) {
    $query = "SELECT * FROM korisnik";
    $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));


    $sql = "SELECT Korisnicko_ime FROM korisnik WHERE Korisnicko_ime = ? ";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $korisnicko);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $msg = "Korisničko ime već postoji!" ?? "";
    } else {
        $query1 = "INSERT INTO korisnik (Ime, Prezime, Korisnicko_ime, Lozinka, Razina) 
            VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);

        if (mysqli_stmt_prepare($stmt, $query1)) {
            mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $korisnicko, $lozinka_hash, $razina);
            mysqli_stmt_execute($stmt);
            $registriranKorisnik = true;
        }
    }

    mysqli_close($dbc);
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="administracija.css">
    <title>Document</title>
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
 </header>


    <?php

    if ($registriranKorisnik == true) {
        echo 'Korisnik je uspješno registriran';
    } else {
         ?>
        <div class="container">
                <div>
                    <form action="" method="POST">
                        <div>
                            <label for="ime">Vaše ime:</label><br>
                            <input id="ime" type="text" name="ime">
                            <br><span class="error" id="porukaIme"><br>
                        </div>
                        <div>
                            <label for="prezime">Vaše prezime:</label><br>
                            <input type="text" name="prezime" id="prezime">
                            <br><span class="error" id="porukaPrezime"><br>
                        </div>
                        <div>
                            <label for="korisnicko">Vaše korisničko ime:</label><br>
                            <input type="text" name="korisnicko" id="korisnicko">
                            <br><span class="error" id="porukaKorisnicko"><br>
                        </div>
                        <div>
                            <label for="lozinka">Vaše lozinka:</label><br>
                            <?php echo '<span>' .$msg. '</span>'; ?>
                            <input type="password" name="lozinka" id="lozinka">
                            <br><span class="error" id="porukaLozinka"><br>
                        </div>
                        <div>
                            <label for="lozinka1">Ponovite lozinku:</label><br>
                            <input type="password" name="lozinka1" id="lozinka1">
                            <br><span class="error" id="porukaLozinka1"><br>
                        </div>
                        <div>
                            <label for="razina">Razina:</label><br>
                            <select id="razina" name="razina">
                                <option value="" disabled selected></option>
                                <option value="nula">Korisnik</option>
                                <option value="jedan">Administrator</option>
                            </select>
                            <br><span class="error" id="porukaRazina"><br>
                        </div>




                        <div>
                            <button type="reset" value="ponisti">Poništi</button>
                            <button id="gumb2" name="posalji2" type="submit" value="prihvati2">Prihvati</button>
                        </div>
                    </form>
                </div>
            </div>
        <footer>
            <p>Copyright Filip Rostohar</p>
        </footer>

        <script type="text/javascript">
            document.getElementById('gumb2').onclick = function() {
                var slanje = true;

                var poljeIme = document.getElementById('ime');
                var ime = poljeIme.value;
                if (ime.length == 0) {
                    slanje = false;
                    poljeIme.style.border = "2px dashed brown";
                    document.getElementById('porukaIme').innerHTML = 'Ime mora biti uneseno';
                }

                var poljePrezime = document.getElementById('prezime');
                var prezime = poljePrezime.value;
                if (prezime.length == 0) {
                    slanje = false;
                    poljePrezime.style.border = "2px dashed brown";
                    document.getElementById('porukaPrezime').innerHTML = 'Prezime mora biti uneseno.';
                }

                var poljeKorisnicko = document.getElementById('korisnicko');
                var korisnicko = poljeKorisnicko.value;
                if (korisnicko.length == 0) {
                    slanje = false;
                    poljeKorisnicko.style.border = "2px dashed brown";
                    document.getElementById('porukaKorisnicko').innerHTML = 'Korisnicko ime mora biti uneseno';
                }


                var poljeLozinka = document.getElementById('lozinka');
                var lozinka = poljeLozinka.value;
                var poljeLozinka1 = document.getElementById('lozinka1');
                var lozinka1 = poljeLozinka1.value;
                if (lozinka.length == 0) {
                    slanje = false;
                    poljeLozinka.style.border = "2px dashed brown";
                    document.getElementById('porukaLozinka').innerHTML = 'Lozinka mora biti unesena';
                } else if (lozinka != lozinka1) {
                    slanje = false;
                    poljeLozinka.style.border = "2px dashed brown";
                    document.getElementById('porukaLozinka').innerHTML = 'Lozinke se ne podudaraju';
                }


                var poljeRazina = document.getElementById('razina');
                if (document.getElementById('razina').selectedIndex == 0) {
                    slanje = false;
                    poljeRazina.style.border = "2px dashed brown";
                    document.getElementById('porukaRazina').innerHTML = 'Odaberite razinu.';
                }


                if (slanje != true) {
                    event.preventDefault();
                }
            };
        </script>
    <?php
    }
    ?>


</body>

</html>