<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAMÓWIENIE</title>
    <link rel="stylesheet" href="../styles/Z-style.css">
    <link rel="icon" href="../logo.png">
</head>
<body>
    <header><a href='../index.php'><img src="../logo.png"></a></header>
    <?php
    if(isset($_GET['error'])){
        $error = $_GET['error'];
        if($error == 'brak-srodkow'){
            echo "<p class='error'>Płatność odrzucona</p>";
        }
        else if($error='niepoprawne-dane'){
            echo "<p class='error'>Niepoprawne dane konta bankowego</p>";
        }
        else{
            return;
        }
    }
    ?>
    <main>
    
    <section>
        <h3>Adres dostawy</h3>
    <form action="z-verifiation.php" method="post">
        <input type="text" name="imie" placeholder="Imię i nazwisko" maxlength="60" value="<?php
        if(isset($_SESSION['imie']) && isset($_SESSION['nazwisko'])){
            echo $_SESSION['imie'] . " " . $_SESSION['nazwisko'];
        }
        ?>">
        <input type="text" name="ulica" placeholder="Ulica i numer" maxlength="60">
        <input type="text" name="kod" placeholder="Kod pocztowy" maxlength="7">
        <input type="text" name="miejscowosc" placeholder="Miejscowość" maxlength="60">
        <input type="text" name="telefon" placeholder="Telefon" maxlength="9">
        <input type="text" name="email" placeholder="E-mail" maxlength="60" value="<?php
        if(isset($_SESSION['email'])){
            echo $_SESSION['email'];
        }
        ?>">
        
    
    <br><br>
        <h3>Dane bankowe</h3>
    
        <input type="text" name="nrkonta" placeholder="nr. konta">
        <input type="password" name="haslo" placeholder="hasło">
        <button type="submit">Zamów</button>
    </form> 
    
    </section>
    <section>
         <?php
                
                $link = mysqli_connect('localhost', 'root', '', 'sklep_internetowy');
                    foreach($_SESSION['koszyk'] as $id => $produkt){
                        
                        $wynik = $link -> query("SELECT * FROM produkty WHERE id_produktu = $id");
                        $przedmiot = $wynik -> fetch_assoc();
                        $id = $przedmiot['id_produktu'];
                        $nazwa = $przedmiot['Nazwa'];
                        $cena = $przedmiot['Cena'];
                        $zdjecie = $przedmiot['Zdjecie'];
                        

                        echo "<div class='przedmiot'>";
                        echo "<img src='../grafiki/$zdjecie'>";
                        echo "<p>$nazwa</p>";
                        echo "<div>";
                        
                        echo "<p>Ilosc: $produkt szt.</p>";
                        echo "<p>Cena: $cena zł</p>";
                        echo "</div>";
                        echo "</div>";
                        
                    }
                ?>
                <br>
                <?php
                if(isset($_POST['cena_pod'])){
                    $cena1 =$_POST['cena_pod'];
                    echo "<p>$cena1</p>";
                }
                ?>
                </section>
    </main>
</body>
</html>