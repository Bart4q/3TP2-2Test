<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOSZYK</title>
    <link rel="stylesheet" href="../styles/K_style.css">
    <link rel="icon" href="../logo.png">
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
    <main>
    <?php
    if(isset($_SESSION['koszyk'])){
        ?>  
        <section>
            <h3>Koszyk <?php
                if(isset($_SESSION['ilosc-k'])){
                echo "(".$_SESSION['ilosc-k'].")";
                }?></h3><br>

            <div id="przedmioty">
                <?php
                $cenaO = 0;
                $link = mysqli_connect('localhost', 'root', '', 'sklep_internetowy');
                $_SESSION['cena_pod'] = 0;
                    foreach($_SESSION['koszyk'] as $id => $produkt){
                        
                        $wynik = $link -> query("SELECT * FROM produkty WHERE id_produktu = $id");
                        $przedmiot = $wynik -> fetch_assoc();
                        $id = $przedmiot['id_produktu'];
                        $nazwa = $przedmiot['Nazwa'];
                        $cena = $przedmiot['Cena'];
                        $zdjecie = $przedmiot['Zdjecie'];
                        $cenaO+= $cena*$produkt;
                        $_SESSION['cena_pod'] += $cena*$produkt;

                        echo "<div class='przedmiot'>";
                        echo "<img src='../grafiki/$zdjecie'>";
                        echo $nazwa;
                        echo "<div>";
                        echo $cena . " zł &nbsp;";
                        echo "<input type='number' id='$id' value='$produkt' min='1' onblur='sprawdz($id, this.value)' oninput='sprawdz($id, this.value)'>&nbsp;";
                        
                        echo "</div>";
                        echo "<button onclick='usun($id)'><img src='../bin.svg' class='kosz'></button>";
                        echo "</div>";
                        
                    }
                ?>
            </div>
            <section id="finalizacja">
                <h3>Łączna kwota: <?=$cenaO;?> zł</h3>
                <button onclick='zamow()' id='zamow'>Złóż zamówienie</button>
            </section>
        </section>
        <?php
    }
    ?>
    </main>
    <script>
        function usun(a){
            window.location.href = "u-koszyk.php?id=" + a;
        }
        function sprawdz(e, ile){
            window.location.href = "u-koszyk.php?zmien=" + e + '&ile=' + ile;
        }
        function zamow(){
            window.location.href = 'zamow.php';
        }
    </script>
</body>
</html>