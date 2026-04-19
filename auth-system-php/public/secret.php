<?php
session_start();

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Strona chroniona</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Witaj, <?php echo $_SESSION['username']; ?>!</h2>
    <p>To jest strona dostępna tylko po zalogowaniu.</p>

    <a href="logout.php"><button>Wyloguj się</button></a> 
</div>
</body>
</html>