<?php
    session_start();
    $link = mysqli_connect('localhost', 'root', '', 'sklep_internetowy');
    if(isset($_GET['wykonano'])){
        echo "<script>alert('Zamówienie zostało złożono pomyślnie')</script>";
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKLEP</title>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <header>
        <a href="index.php"><img src="logo.png" alt="logo" id="h_logo"></a>
        <form action="" method="get" id="szukaj">
            <input type="text" name="wyszukiwane" placeholder="Wyszukaj produkt">
            <input type="hidden" name="kategoria" value="none">
            <input type="submit" value="Szukaj">
        </form>
        <div>
        <a href="./sites/login.php">Twoje konto</a>
        <a href="./sites/koszyk.php">Koszyk <?php
        if(isset($_SESSION['ilosc-k'])){
            $ile = $_SESSION['ilosc-k'];
            echo "($ile)";
        }
        
        ?></a>
        </div>
    </header>
    <section id="menu">
        <a href="?kategoria=Komputery">Komptery</a>
        <a href="?kategoria=Laptopy">Laptopy</a>
        <a href="?kategoria=Telefony">Telefony</a>
        <a href="?kategoria=Monitory">Monitory</a>
    </section>
    <main>
        <section id="filtr"> 
            <form id='form'>
                
                <?php
                $wynik = $link -> query("SELECT * FROM produkty");
                ?>
            </form>
        </section>
        <section id="products"> 
            <?php 
            
            $produkty = $link -> query("SELECT * FROM produkty");
            while($wiersz = $produkty -> fetch_assoc()) {
                if(isset($_GET['wyszukiwane']) && str_contains($wiersz['Nazwa'],$_GET['wyszukiwane'])){
                    echo "<a href='./sites/product.php?id_p=". $wiersz['id_produktu']."' class='produkt'>";
                echo "<img src='./grafiki/".$wiersz['Zdjecie']."'><br>";
                echo "<p>".$wiersz['Nazwa']."</p>";
                echo "<p>".$wiersz['Cena']." zł</p>";
                echo "</a>";
                
                }
                else if(!isset($_GET['kategoria'])){
                echo "<a href='./sites/product.php?id_p=". $wiersz['id_produktu']."' class='produkt'>";
                echo "<img src='./grafiki/".$wiersz['Zdjecie']."'><br>";
                echo "<p>".$wiersz['Nazwa']."</p>";
                echo "<p>".$wiersz['Cena']." zł</p>";
                echo "</a>";
                }
                else if($_GET['kategoria']==$wiersz['Kategoria']) {
                    echo "<a href='./sites/product.php?id_p=". $wiersz['id_produktu']."' class='produkt'>";
                    echo "<img src='./grafiki/".$wiersz['Zdjecie']."'><br>";
                    echo "<p>".$wiersz['Nazwa']."</p>";
                    echo "<p>".$wiersz['Cena']." zł</p>";
                    echo "</a>";
                }
                
            }
            ?>
        </section>
        </main>
    <style>
    
    .produkt {
        height: 200px;
        display: flex;
        flex-direction: column;
        width: 200px;
        margin: 10px;
        padding: 20px;
        border-radius: 10px;
        justify-content: center;
        align-items: center;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    }
    .produkt p {
        text-align: center;
        color: black;
        font-weight: bold;
    }
    .produkt img {
        height: 100px;
        width: fit-content;
    }
    .produkt:hover{
        box-shadow: 0px 0px 5px 2px rgba(223, 226, 255, 1);
    }
    </style>

     
    
</body>
</html>