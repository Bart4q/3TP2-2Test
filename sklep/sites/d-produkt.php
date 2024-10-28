<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DODAJ PRODUKT</title>
    <link rel="stylesheet" href="../styles/dodaj-style.css">
    <link rel="icon" href="../logo.png">
</head>
<body>
<?php
    if(isset($_SESSION['email']) && $_SESSION['uprawnienia'] == 'admin'){

        ?>
        <header><a href='../index.php'><img src="../logo.png"></a></header>
        <main>
        <?php
        $link = new mysqli('localhost','root','','sklep_internetowy');
        ?>
        <form action="d-produkt.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nazwa" maxlength="60" placeholder="nazwa">
            <input type="text" name="producent" maxlength="50" placeholder="producent">
            <textarea name="opis"  cols="30" rows="10" placeholder="opis"></textarea>
            <input type="file" name="zdjecie">
            <input type="number" name="cena" placeholder="cena">
            <input type="text" name="kategoria" maxlength="50" placeholder="kategoria">
            <button type="submit">DODAJ</button>
        </form>
        </main>
    
            
    <?php
    if(isset($_POST['nazwa'])){
        $img_name = $_FILES['zdjecie']['name'];
        $tmp_img_name = $_FILES['zdjecie']['tmp_name'];
        $folder = '../grafiki/';
        move_uploaded_file($tmp_img_name, $folder.$img_name);

        $nazwa = $_POST['nazwa'];
        $producent = $_POST['producent'];
        $opis = $_POST['opis'];
        $cena = $_POST['cena'];
        $kategoria = $_POST['kategoria'];

        $link -> query("INSERT INTO produkty VALUES(null, '$nazwa','$producent','$opis','$img_name',$cena, '$kategoria')");
        header('location: produkty.php');
    }
    }
    else {
    header('location: ../index.php');
    }
    ?>
</body>
</html>
