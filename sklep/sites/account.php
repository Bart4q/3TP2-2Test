<?php
    session_start();
    $link = new mysqli('localhost','root','','sklep_internetowy');
    $email = $_SESSION['email'];
    $wynik = $link -> query("SELECT Imie, Nazwisko FROM uzytkownicy WHERE Email = '$email'");
    $uzytkownik = $wynik -> fetch_assoc();

    $_SESSION['imie'] = $uzytkownik['Imie'];
    $_SESSION['nazwisko'] =$uzytkownik['Nazwisko'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONTO</title>
    <link rel="icon" href="../logo.png">
    <link rel="stylesheet" href="../styles/A_style.css">
</head>
<body>
    <header>
        <a href="../index.php"><img src="../logo.png" alt="logo" id="h_logo"></a>
        <a href="./logout.php">WYLOGUJ</a>
        <a href="koszyk.php">Koszyk<?php
        if(isset($_SESSION['ilosc-k'])){
            $ile = $_SESSION['ilosc-k'];
            echo "($ile)";
        }
        
        ?></a>
        
    </header>
    <main>

        <nav>
            <?php 
            if(isset($_SESSION['uprawnienia']) && $_SESSION['uprawnienia']=='admin'){
            ?>
            <a href="konta.php">KONTA UŻYTKOWNIKÓW</a>
            <a href="zamowienia.php">ZAMÓWIENIA</a>
            <a href="produkty.php">PRODUKTY</a>
            <?php
            }
            else {
            ?>
            <button onclick='sprawdz_zam()'>TWOJE ZAMÓWIENIA</button>
            <a href="mailto: sklep@sklep.pl">SKONTAKTUJ SIĘ Z NAMI</a>
            <?php
            }
            ?>
        </nav>
        
        <div id="konto">
            <img src="../user.png" id="icon">
            <p class="dane"> EMAIL: <?php echo $_SESSION['email']; ?></p> <br>
            <p class="dane"> Imię: <?php echo $_SESSION['imie']; ?></p> <br>
            <p class="dane"> Nazwisko: <?php echo $_SESSION['nazwisko']; ?></p> <br>
            <p class="dane"> Hasło: <?php echo $_SESSION['haslo']; ?></p> <br>
            <p class="dane"> Uprawnienia: <?= $_SESSION['uprawnienia']?></p>
            <a href="change_profile.php" id="zmien">ZMIEŃ DANE KONTA</a>
        <div>
        <p id='par'>
        <script>

            var zam_btn =document.getElementById('twoje_zam');
            function sprawdz_zam() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange =function() {
                    document.getElementById('par').innerHTML = this.responseText;
                }
                xmlhttp.open("GET", "t-zamowienia.php"), true;
                xmlhttp.send();
            }

        </script>
        </p>
        <style>
            table{
    border: 1px solid black;
    border-collapse: collapse;
}
td, th{
    padding: 10px;
    font-size: medium;
    border: 1px solid black;
}
        </style>
    </main>
</body>
</html>