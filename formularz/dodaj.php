<?php
require("connect.php");
$firstName = $_POST['imie'];
$secondName = $_POST['nazwisko'];

$sql = "INSERT INTO autorzy(IDAutor, Imie, Nazwisko) VALUES ('','$firstName','$secondName')";
$sql2 = "SELECT Imie, Nazwisko FROM autorzy";

$result = $conn->query($sql);


if ($result === TRUE) {
    $result2 = $conn->query($sql2);


    if ($result2) {
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                echo "Imię: " . $row['Imie'] . " Nazwisko: " . $row['Nazwisko'] . "<br />";
            }
        } else {
            echo "Nie znaleziono rekordów!";
        }
    } else {
        echo "Błąd w zapytaniu SELECT: " . $conn->error;
    }
} else {
    echo "Błąd w zapytaniu INSERT: " . $conn->error;
}


?>