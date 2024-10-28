<?php
session_start();

if(isset($_POST['imie'])){
    $email = $_SESSION['email'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $haslo = $_POST['haslo'];

    $link = new mysqli('localhost','root','','sklep_internetowy');
    
    
        $link -> query("UPDATE uzytkownicy SET Imie = '$imie', Nazwisko = '$nazwisko', Haslo = PASSWORD('$haslo') WHERE Email = '$email'");
    $_SESSION['haslo'] = $haslo;
        header("location: ./account.php");
     
}


?>