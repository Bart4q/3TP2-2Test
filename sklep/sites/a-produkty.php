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
        $wynik = $link -> query("SELECT * FROM produkty WHERE id_produktu = $id");
        $produkt = $wynik -> fetch_assoc();

        $nazwa = $produkt['Nazwa'];
        $producent =$produkt['Producent'];
        $opis = $produkt['Opis'];
        $zdjecie = $produkt['Zdjecie'];
        $cena = $produkt['Cena'];
        $kategoria = $produkt['Kategoria'];

        if(isset($_GET['usun'])){
            $link -> query("DELETE FROM produkty WHERE id_produktu = $id");
            header('location: produkty.php');
        }
    
    ?>
    <form action="a-produkty.php?id=<?=$id?>" method="post">
            <input type="text" name='id2' value="<?=$id?>" readonly>
            <input type="text" name='nazwa2' value="<?=$nazwa?>">
            <input type="text" name='producent2' value="<?=$producent?>">
            <input type="text" name='opis2' value="<?=$opis?>">
            <input type="text" name='zdjecie2' value="<?=$zdjecie?>">
            <input type="number" name='cena2' value="<?=$cena?>">
            <input type="text" name='kategoria2' value="<?=$kategoria?>">
            <button type="submit">ZAPISZ ZMIANY</button>
    </form>
    <?php
    if(isset($_POST['nazwa2'])){
        $nazwa2 = $_POST['nazwa2'];
        $producent2 =$_POST['producent2'];
        $opis2 = $_POST['opis2'];
        $zdjecie2 = $_POST['zdjecie2'];
        $cena2 = $_POST['cena2'];
        $kategoria2 = $_POST['kategoria2'];
        $link -> query("UPDATE produkty SET Nazwa = '$nazwa2',Producent='$producent2',Opis='$opis2',Zdjecie='$zdjecie2',Cena=$cena2,Kategoria='$kategoria2' WHERE id_produktu = $id");
        header('location: produkty.php');
    }
    }
    else {
        header('location: ../index.php');
    }
    ?>
</body>
</html>