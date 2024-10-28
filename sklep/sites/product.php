<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php ?></title>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" href="../styles/P_style.css">
</head>
<body>
    <header>
        <a href="../index.php"><img src="../logo.png" alt="logo" id="h_logo"></a>
        <div>
            <a href="./login.php">Twoje konto</a>
            <a href="koszyk.php">Koszyk<?php
        if(isset($_SESSION['ilosc-k'])){
            $ile = $_SESSION['ilosc-k'];
            echo "($ile)";
        }
        
        ?></a>
        </div>
    </header>
    <section>
    <?php
            $link = mysqli_connect('localhost','root','','sklep_internetowy');
            if(isset($_GET['id_p'])){
                $idp = $_GET['id_p'];
            $zapytanie = $link -> query("SELECT * FROM produkty WHERE id_produktu = $idp");
            $produkt = $zapytanie -> fetch_assoc();
            if(mysqli_num_rows($zapytanie) != 0){
                if(isset($_GET['dodano'])){
                    $ile=$_GET['dodano'];
                    echo "<p class='dodany'>Produkt w ilości $ile sztuk został pomyślnie dodany do koszyka.</p>";
                }
                echo "<div id='product'>";
                echo "<h1>".$produkt['Nazwa']."</h1>";
                echo "<img src='../grafiki/".$produkt['Zdjecie']."'><br>";
                echo "<p>".$produkt['Cena']." zł</p><br>";
                echo "<p id='opis'>".$produkt['Opis']."</p>";
                $id = $produkt['id_produktu'];
                echo "<form action='d-koszyk.php' method='post' id='form'><input type='number' name='ilosc' value='1' min='1' onblur='sprawdz()' id='ilosc'><input type='text' name='id' value=$id hidden>&nbsp;<button type='submit' class='dodaj'>Dodaj do koszyka</button></form>";
                echo "</div>";
            }
            }
        ?>
        <script>
            
            function sprawdz(){
                var ilosc =document.getElementById('ilosc');
                if(ilosc.value < 1){
                    ilosc.value=1;
                }
            }
        </script>
        </section>
</body>
</html>