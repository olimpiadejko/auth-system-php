<?php 
require 'baseConnection.php'; // dołączenie pliku z połączeniem do bazy danych
session_start(); // uruchamianie sesji

$errors = []; // tablica na błędy

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Pobieramy dane
    $username  = $_POST['username'] ?? '';//jeśli nie istnieje to przypisuje pusty string
    $password  = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    $email     = $_POST['email'] ?? '';
    $phone     = $_POST['phone'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $lastname  = $_POST['lastname'] ?? '';

    // --- REGEX do hasła ---
    // Wymagania: min 8 znaków, duża liter, mała litera, cyfra
    $password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/"; //wzorzec tekstowy używany do walidacji hasła

    if (!preg_match($password_regex, $password)) { //sprawdza czy hasło nie pasuje do wzorca
        $errors[] = "Hasło musi mieć min. 8 znaków, zawierać małą literę, dużą literę i cyfrę.";
    }

    // Sprawdzenie powtórzenia hasła
    if ($password !== $password2) {
        $errors[] = "Hasła nie są takie same.";
    }

    // Jeśli NIE ma błędów
    if (empty($errors)) {

        // Hashowanie hasła
        $hashed = password_hash($password, PASSWORD_DEFAULT); //tworzy bezpieczny hash hasła

        // Zapis do bazy
        $query = "INSERT INTO users (username, password, email, phone, firstname, lastname)
                  VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ssssss",
            $username, $hashed, $email, $phone, $firstname, $lastname
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php?registration=success"); 
            exit;
        } else {
            $errors[] = "Błąd przy zapisie do bazy.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">

<h2>Rejestracja użytkownika</h2>

<?php
if (!empty($errors)) {
    echo "<ul>";
    foreach ($errors as $err) echo "<li>$err</li>";
    echo "</ul>";
}
?>

<form method="POST">
    
    <label>Login:</label><br>
    <input type="text" name="username" value="testLogin" placeholder="np. jan_kowalski123" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="test@mail.com" placeholder="np. jan.kowalski@example.com" required><br><br>

    <label>Telefon:</label><br>
    <input type="text" name="phone" value="+48 111 222 333" placeholder="np. +48 123 456 789" required><br><br>

    <label>Imię:</label><br>
    <input type="text" name="firstname" value="Jan" placeholder="np. Jan" required><br><br>

    <label>Nazwisko:</label><br>
    <input type="text" name="lastname" value="Kowalski" placeholder="np. Kowalski" required><br><br>

    <label>Hasło:</label><br>
    <input type="password" name="password" value="TestLogin1" required><br>
     <small>Min 8 znaków, duża litera, mała litera i cyfra.</small><br><br>

    <label>Powtórz hasło:</label><br>
    <input type="password" name="password2" value="TestLogin1" required><br><br>

    <button type="submit" name="register">Zarejestruj</button>

</form>


<a href="index.php">Masz już konto? Zaloguj się</a>

</div>
</body>
</html>
