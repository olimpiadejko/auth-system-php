<?php
//musi być wywołana w każdym pliku PHP, który używa sesji, Bez tej funkcji, 
//PHP nie miałoby dostępu do tablicy $_SESSION ani nie wiedziałoby, którą sesję ma zniszczyć.
session_start(); //uruchamianie sesji
session_unset(); // usuwanie wszystkich zmiennych sesji(np.status zalogowania albo nazwe użytkownika) żeby po zniszczeniu sesji nie pozostały żadne dane
session_destroy(); // niszczenie sesji
header("Location: index.php"); // przekierowanie do strony głównej(Wysyła nagłówek HTTP do przeglądarki użytkownika.)
exit;// zakończenie skryptu
//gwarantuje, że po wysłaniu nagłówka przekierowującego żaden dodatkowy kod (w tym HTML) nie zostanie 
//wysłany do przeglądarki
?>
