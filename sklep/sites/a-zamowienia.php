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
        $wynik = $link -> query("SELECT * FROM zamowienia WHERE id_zamowienia = $id");
        $zamowienie = $wynik -> fetch_assoc();

        $id = $zamowienie['id_zamowienia'];
        $imie = $zamowienie['imie_nazwisko'];
        $ulica = $zamowienie['ulica'];
        $kod = $zamowienie['kod_pocztowy'];
        $miejscowosc = $zamowienie['miejscowosc'];
        $telefon = $zamowienie['telefon'];
        $email = $zamowienie['email'];
        $id_k = $zamowienie['id_klienta'];
        $status = $zamowienie['status'];


        if(isset($_GET['usun'])){
            $link -> query("DELETE FROM zamowienia WHERE id_zamowienia = $id");
            header('location: zamowienia.php');
        }
        
        ?>
        <form action="a-zamowienia.php?id=<?=$id?>" method="post">
            <input type="text" name='id2' value="<?=$id?>" readonly>
            <input type="text" name='imie2' value="<?=$imie?>" placeholder="imie i nazwisko">
            <input type="text" name='ulica2' value="<?=$ulica?>" placeholder="ulica i numer">
            <input type="text" name='kod2' value="<?=$kod?>" placeholder="kod pocztowy">
            <input type="text" name='miejscowosc2' value="<?=$miejscowosc?>" placeholder="miejscowosc">
            <input type="text" name='telefon2' value="<?=$telefon?>" placeholder="telefon">
            <input type="text" name='email2' value="<?=$email?>" placeholder="email">
            <input type="text" name='id-k2' value="<?=$id_k?>" readonly>
            <input type="text" name='status2' value="<?=$status?>" placeholder="status">
            <button type="submit">ZAPISZ ZMIANY</button>
        </form>
        </main>
        <?php
        if(isset($_POST['imie2'])){
            $id2 = $_POST['id2'];
            $imie2= $_POST['imie2'];
            $ulica2 = $_POST['ulica2'];
            $miejscowosc2 = $_POST['miejscowosc2'];
            $telefon2 = $_POST['telefon2'];
            $email2 = $_POST['email2'];
            $id_k2 = $_POST['id-k2'];
            $status2 = $_POST['status2'];
            $kod2 = $_POST['kod2'];
            $link -> query("UPDATE zamowienia SET `imie_nazwisko` = '$imie2', `ulica`='$ulica2', `kod_pocztowy`='$kod2', `miejscowosc`='$miejscowosc2',`telefon`='$telefon2',`email`='$email2',`status`='$status2' WHERE `id_zamowienia`=$id2");
            header('location: zamowienia.php');
            }
    }
        ?>
</body>
</html>