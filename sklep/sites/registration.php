<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REJESTRACJA</title>
    <link rel="icon" href="../logo.png">
    <link rel="stylesheet" href="../styles/R_styles.css">
    <script type="text/JavaScript"  src="../scripts/Register_Verify.js" defer></script>
</head>
<body>
    
    <header>
        <a href="../index.php"><img src="../logo.png" alt="logo" id="h_logo"></a>
    </header>
    <section>
    <div>
    <h1>Zarejestruj się</h1>
    <form action="" method="post" id="zarejestruj">
        <input type="text" id="imie" name="r_imie" placeholder="Podaj imię">
        <input type="text" id="nazwisko" name="r_nazwisko" placeholder="Podaj nazwisko">
        <input type="text" id="email" name="r_email" placeholder="Podaj email">
        <input type="password" id="haslo" name="r_haslo" placeholder="Podaj hasło">
        <input type="password" id="phaslo" name="p_haslo" placeholder="Powtórz hasło">
        <input type="button"  value="Zarejestruj" id="btn_zarejestruj">
    </form>
    <a href="./login.php">Powrót do logowania</a>
    </div>
    </section>
    
    <?php 
    
    $link = mysqli_connect('localhost','root','','sklep_internetowy');

    if(isset($_POST['r_imie']) && isset($_POST['r_nazwisko']) && isset($_POST['r_email']) && isset($_POST['r_haslo'])) {
        $imie =$_POST['r_imie'];
        $nazwisko=$_POST['r_nazwisko'];
        $email =$_POST['r_email'];
        $haslo = $_POST['r_haslo'];
        $juzjest = false;

        $p_email = $link -> query("SELECT `Email` FROM uzytkownicy");
        while($wiersz = $p_email -> fetch_assoc()){
            if($wiersz['Email'] == $email) {
                $juzjest = true;
            }
            else {
                $juzjest = false;
            }
        }

        if($juzjest == false){
        $link -> query("INSERT INTO uzytkownicy(`Imie`,`Nazwisko`,`Email`,`Haslo`) VALUES ('$imie', '$nazwisko', '$email', PASSWORD('$haslo'))");
        header("location:./login.php");
    }
        else {
            echo "<script> alert('Użytkownik o podanym email już istnieje'); </script>";
        }

    }


    // CREATE TRIGGER nadaj_uprawnienia_klienta
    // BEFORE INSERT ON uzytkownicy
    // FOR EACH ROW
    // SET NEW.Uprawnienia = 'klient';

    ?>
    
</body>
</html>