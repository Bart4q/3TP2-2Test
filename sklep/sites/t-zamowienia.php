<?php
session_start();
if(isset($_SESSION['email'])){
    $em = $_SESSION['email'];
   
    $link = new mysqli('localhost','root','','sklep_internetowy');
    $wynik = $link -> query("SELECT z.ulica, z.kod_pocztowy, z.miejscowosc, z.telefon,z.email,z.status FROM zamowienia z JOIN uzytkownicy u ON z.id_klienta = u.id_uzytkownika WHERE u.Email = '$em'");
    if(mysqli_num_rows($wynik) != 0){
    echo "<table>";
    while($wiersz = $wynik -> fetch_assoc()){
        echo "<tr>";
            echo "<td>".$wiersz['ulica']."</td>";
            echo "<td>".$wiersz['kod_pocztowy']."</td>";
            echo "<td>".$wiersz['miejscowosc']."</td>";
            echo "<td>".$wiersz['telefon']."</td>";
            echo "<td>".$wiersz['email']."</td>";
            echo "<td>".$wiersz['status']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    }
    else {
        echo "<p>Brak zamówień</p>";
    }
}
?>