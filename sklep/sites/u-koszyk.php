<?php

session_start();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $ile = $_SESSION['koszyk'][$id];
    $_SESSION['ilosc-k'] -= $ile;
    unset($_SESSION['koszyk'][$id]);
    header("location: koszyk.php");

}
else if(isset($_GET['zmien']) && isset($_GET['ile'])){
    $id = $_GET['zmien'];
    $ile = $_GET['ile'];
    $_SESSION['koszyk'][$id] = $ile;
    $ilosc = 0;
    foreach($_SESSION['koszyk'] as $i => $val){
        $ilosc+= $val;
    }
    $_SESSION['ilosc-k'] = $ilosc;
    header("location: koszyk.php");
}
else{
    header("location: koszyk.php");
}



?>