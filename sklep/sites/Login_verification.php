<?php 
session_start();
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

    <?php 
    
    if(isset($_POST['l_email']) && isset($_POST['l_haslo'])) {
        $email = $_POST['l_email'];
        $haslo = $_POST['l_haslo'];
        $link = mysqli_connect('localhost', 'root', '', 'sklep_internetowy');
        $uzytkownicy = $link -> query("SELECT * FROM uzytkownicy WHERE `Email` = '$email' AND `Haslo` = PASSWORD('$haslo')");
        $dane = $uzytkownicy -> fetch_assoc();
        
        
        
        if(mysqli_num_rows($uzytkownicy) != 0) {
            $_SESSION['id-klienta'] = $dane['id_uzytkownika'];
           $_SESSION['email'] = $dane['Email'];
           $_SESSION['imie'] = $dane['Imie'];
           $_SESSION['nazwisko'] = $dane['Nazwisko'];
           $_SESSION['haslo'] = $haslo;
           $_SESSION['uprawnienia'] = $dane['Uprawnienia'];
           header("location:./account.php");
        }
        else {
            echo "<script> alert('Niepoprawne dane'); </script>";
            header("location:./login.php");
        } 
    }

    ?>

</body>
</html>
