<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRODUKTY</title>
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
        $wynik = $link -> query("SELECT * FROM produkty");
        echo "<table>";
        echo "<tr><th>id_produktu</th><th>Nazwa</th><th>Producent</th><th>Cena</th><th>Opis</th><th>Zdjęcie</th><th>Kategoria</th><th>Edycja</th><th>USUŃ</th></tr>";
        while($wiersz = $wynik -> fetch_assoc()){
            $id = $wiersz['id_produktu'];
            echo "<tr>";
            echo "<td>".$wiersz['id_produktu']."</td>";
            echo "<td>".$wiersz['Nazwa']."</td>";
            echo "<td>".$wiersz['Producent']."</td>";
            echo "<td>".$wiersz['Cena']."</td>";
            echo "<td>".$wiersz['Opis']."</td>";
            echo "<td>".$wiersz['Zdjecie']."</td>";
            echo "<td>".$wiersz['Kategoria']."</td>";
            echo "<td><a href='a-produkty.php?id=$id'>Edytuj</a></td>";
            echo "<td><a href='a-produkty.php?id=$id&usun'>Usuń</a></td>";
            echo "</tr>";
        
        }
        echo "</table>";

        echo "<a href='d-produkt.php' class='dodajp'>Dodaj produkt</a>";
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