<?php 
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGOUT</title>
    <link rel="icon" href="../logo.png">
</head>
<body>
    <!--<form action="./login.php" id="wyloguj"> </form>-->
    <?php
    //echo "<script>document.getElementById('wyloguj').submit();  </script>";
    $_SESSION['wyloguj'] = 'tak';
    header("location:../index.php");
    ?>

</body>
</html>