<?php
session_start();
if(isset($_POST['imie'])){
    $imie = $_POST['imie'];
    $ulica = $_POST['ulica'];
    $kod = $_POST['kod'];
    $miejscowosc = $_POST['miejscowosc'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    if(isset($_SESSION['id-klienta'])){
        $id_uz = (int)$_SESSION['id-klienta'];
    }
    else {
        $id_uz = null;
    }

    $linkBank = new mysqli("localhost","root","","bank");
    $linkZam = new mysqli("localhost","root","","sklep_internetowy");
    if(!empty($linkBank)){
        if(isset($_POST['nrkonta'])){
            $nr = $_POST['nrkonta'];
            $haslo = $_POST['haslo'];
            $cena = $_SESSION['cena_pod'];

            $wynik = $linkBank -> query("SELECT nr_konta, stan_konta FROM konta WHERE nr_konta = '$nr' AND haslo = PASSWORD('$haslo')");
           
            $konto = $wynik -> fetch_assoc();
            if(mysqli_num_rows($wynik) == 1){
                
                
                $linkBank -> query("BEGIN");
                $linkZam -> query("BEGIN");
                
                $linkBank -> query("UPDATE konta SET stan_konta = stan_konta - $cena WHERE nr_konta = '$nr'");
                $linkBank -> query("UPDATE konta SET stan_konta = stan_konta + $cena WHERE nr_konta = '9999999999999999'");
                $stat = 'W trakcie realizacji';
                $linkZam -> query("INSERT INTO zamowienia (`imie_nazwisko`, `ulica`, `kod_pocztowy`, `miejscowosc`, `telefon`, `email`, `id_klienta`, `status`) VALUES('$imie', '$ulica', '$kod', '$miejscowosc', '$telefon', '$email', $id_uz, '$stat');");


                $wynik = $linkBank -> query("SELECT stan_konta FROM konta WHERE nr_konta = '$nr'");
                $stan = $wynik -> fetch_assoc();
                if($stan['stan_konta'] < 0){
                    $linkZam -> query("ROLLBACK");
                    $linkBank -> query("ROLLBACK");
                    header('location: zamow.php?error=brak-srodkow');
                }
                else {
                    $linkZam ->query("COMMIT");
                    $linkBank ->query("COMMIT");
                    unset($_SESSION['koszyk']);
                    unset($_SESSION['ilosc-k']);
                    header("location: ../index.php?wykonano");
                }
            }
            else{
                header('location: zamow.php?error=niepoprawne-dane');
            }
            
        }
    }
}
else {
    header('loaction: ../index.php');
}

?>