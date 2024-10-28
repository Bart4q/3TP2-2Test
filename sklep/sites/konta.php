<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONTA</title>
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
        $wynik = $link -> query("SELECT * FROM uzytkownicy");
        echo "<table>";
        echo "<tr><th>id_uzytkownika</th><th>Imie</th><th>Nazwisko</th><th>Email</th><th>Haslo</th><th>Uprawnienia</th><th>Edycja</th><th>Usuń</th></tr>";
        

        while($wiersz = $wynik -> fetch_assoc()){
            $id = $wiersz['id_uzytkownika'];
            echo "<tr>";
            echo "<td>".$wiersz['id_uzytkownika']."</td>";
            echo "<td>".$wiersz['Imie']."</td>";
            echo "<td>".$wiersz['Nazwisko']."</td>";
            echo "<td>".$wiersz['Email']."</td>";
            echo "<td>".$wiersz['Haslo']."</td>";
            echo "<td>".$wiersz['Uprawnienia']."</td>";
            echo "<td><a href='a-uzytkownicy.php?id=$id'>Edytuj</a></td>";
            echo "<td><a href='a-uzytkownicy.php?id=$id&usun'>Usuń</a></td>";
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