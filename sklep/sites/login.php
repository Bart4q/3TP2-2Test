<?php
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGOWANIE</title>
    <link rel="stylesheet" href="../styles/L_Style.css">
    <link rel="icon" href="../logo.png">
</head>
<body>
   <header>
    <a href="../index.php"><img src="../logo.png" alt="logo" id="h_logo"></a>
   </header>
   <section>
    <div>
    <h1>Zaloguj się</h1>
    <form action="./Login_verification.php" method="post" id="zaloguj">
        <input type="text" name="l_email" placeholder="Email">
        <input type="password" name="l_haslo" placeholder="Hasło">
        <input type="submit" value="Zaloguj" id="btn_zaloguj">
    </form>
    <a href="./registration.php">Zarejestruj się</a>
    </div>
    </section>

    

    <?php
    
    if(isset($_SESSION['email'])){
        header("location:./account.php");
    }
?>


</body>
</html>