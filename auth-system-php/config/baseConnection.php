<?php
$connection = mysqli_connect('localhost', 'olimpia_user', 'OlimpiaBaza123','olimpiad'); // połączenie z bazą danych
if (mysqli_connect_errno()) { // po podłączeniu sprawdzamy czy nie ma błędu
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error()); //die - kończy wykonywanie skryptu i wypisuje podany komunikat
    // mysqli_connect_errno() - zwraca numer błędu połączenia
}
?>