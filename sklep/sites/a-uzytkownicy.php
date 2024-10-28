<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDYCJA</title>
    <link rel="stylesheet" href="../styles/psz-style.css">
    <link rel="icon" href="../logo.png">
</head>
<body>
    <?php
    if(isset($_GET['id']) && isset($_SESSION['email']) && $_SESSION['uprawnienia'] == 'admin'){
        ?>
        <header><a href='../index.php'><img src="../logo.png"></a></header>
        <main>
        <?php
        
        $id = $_GET['id'];
        $link = new mysqli('localhost','root','','sklep_internetowy');
        $wynik = $link -> query("SELECT * FROM uzytkownicy WHERE id_uzytkownika = $id");
        $uzytkownik = $wynik -> fetch_assoc();

        $imie = $uzytkownik['Imie'];
        $nazwisko = $uzytkownik['Nazwisko'];
        $email = $uzytkownik['Email'];
        $haslo = $uzytkownik['Haslo'];
        $uprawnienia = $uzytkownik['Uprawnienia'];
        
        if(isset($_GET['usun'])){
            $link -> query("DELETE FROM uzytkownicy WHERE id_uzytkownika = $id");
            header('location: konta.php');
        }
    
    ?>
    <form action="a-uzytkownicy.php?id=<?=$id?>" method="post">
            <input type="text" name='id2' value="<?=$id?>" readonly>
            <input type="text" name='imie2' value="<?=$imie?>">
            <input type="text" name='nazwisko2' value="<?=$nazwisko?>">
            <input type="text" name='email2' value="<?=$email?>">
            <input type="text" name='haslo2' value="<?=$haslo?>">
            <input type="text" name='uprawnienia2' value="<?=$uprawnienia?>">
            <button type="submit">ZAPISZ ZMIANY</button>
    </form>
    <?php
        if(isset($_POST['imie2'])){
            $id2 = $_POST['id2'];
            $imie2= $_POST['imie2'];
            $nazwisko2 = $_POST['nazwisko2'];
            $email2 = $_POST['email2'];
            $haslo2 = $_POST['haslo2'];
            $uprawnienia2 = $_POST['uprawnienia2'];
            $czyJest = $link -> query("SELECT Email FROM uzytkownicy WHERE Email = '$email2'");
            
            if((mysqli_num_rows($czyJest) == 1 && $email == $email2) || mysqli_num_rows($czyJest) == 0){
            $link -> query("UPDATE uzytkownicy SET `Imie` = '$imie2', `Nazwisko` = '$nazwisko2', `Email` = '$email2', `Haslo` = PASSWORD('$haslo2'), `Uprawnienia` = '$uprawnienia2' WHERE id_uzytkownika = $id");
            header('location: konta.php');
            }
            else {
                echo "<script>alert('Podany e-mail już istnieje w bazie.');</script>";
            }
        }
    }
        ?>
</body>
</html>