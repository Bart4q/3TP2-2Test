<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHANGE PROFILE</title>
    <link rel="stylesheet" href="../styles/CP_style.css">
    <link rel="icon" href="../logo.png">
</head>
<body>
    <?php 
        if(isset($_SESSION['email'])){

            ?>
            <header>
                <a href="../index.php"><img src="../logo.png" alt="logo" id="h_logo"></a>
                <a href="account.php">POWRÓT</a>
                <a href="koszyk.php">Koszyk<?php
        if(isset($_SESSION['ilosc-k'])){
            $ile = $_SESSION['ilosc-k'];
            echo "($ile)";
        }
        
        ?></a>
            </header>
            <main>
                <form action="./e_verification.php" method="post">
                    
                    <label for="imie">Imie:</label>
                    <input type="text" name='imie' value='<?=$_SESSION['imie']?>'>
                    <label for="nazwisko">nazwisko:</label>
                    <input type="text" name='nazwisko' value='<?=$_SESSION['nazwisko']?>'>
                    <label for="haslo">Hasło:</label>
                    <input type="text" name='haslo' value='<?=$_SESSION['haslo']?>'>

                    <button type="submit">ZMIEŃ</button>
                </form>

                
            </main>
            <?php
        }
    ?>
</body>
</html>