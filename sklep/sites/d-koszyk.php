<?php
session_start();
if(isset($_POST['ilosc'])){
$ilosc = $_POST['ilosc'];
$id = $_POST['id'];
$_SESSION['ilosc-k']+=$ilosc;

$_SESSION['koszyk'][$id] += $ilosc;


header("location: product.php?id_p=$id&dodano=$ilosc");
}
?>