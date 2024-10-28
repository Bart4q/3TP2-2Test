<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZAMÓWIENIA</title>
    <link rel="stylesheet" href="../styles/psz-style.css">
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
        $wynik = $link -> query("SELECT * FROM zamowienia");
        echo "<table cellspacng='0'>";
        echo "<tr>";
        echo "<th>id_zamowienia</th>";
        echo "<th>imie_nazwisko</th>";
        echo "<th>ulica</th>";
        echo "<th>kod_pocztowy</th>";
        echo "<th>miejscowosc</th>";
        echo "<th>telefon</th>";
        echo "<th>email</th>";
        echo "<th>id_klienta</th>";
        echo "<th>status</th>";
        echo "<th>Edycja</th>";
        echo "<th>Usuń</th>";
        echo "</tr>";
        while($wiersz = $wynik -> fetch_assoc()){
            $id = $wiersz['id_zamowienia'];
            echo "<tr>";
            echo "<td>".$wiersz['id_zamowienia']."</td>";
            echo "<td>".$wiersz['imie_nazwisko']."</td>";
            echo "<td>".$wiersz['ulica']."</td>";
            echo "<td>".$wiersz['kod_pocztowy']."</td>";
            echo "<td>".$wiersz['miejscowosc']."</td>";
            echo "<td>".$wiersz['telefon']."</td>";
            echo "<td>".$wiersz['email']."</td>";
            echo "<td>".$wiersz['id_klienta']."</td>";
            echo "<td>".$wiersz['status']."</td>";
            echo "<td><a href='a-zamowienia.php?id=$id'>Edytuj</a></td>";
            echo "<td><a href='a-zamowienia.php?id=$id&usun'>Usuń</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>

        
        </main>

        
        <?php
    }
    else {
        header('location: ../index.php');
    }
    ?>
</body>
</html>