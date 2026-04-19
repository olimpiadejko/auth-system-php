<?php
session_start();
require 'baseConnection.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Pobranie użytkownika z bazy
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Logowanie udane
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: secret.php");
        exit;
    } else {
        $errors[] = "Nieprawidłowy login lub hasło";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

if (isset($_GET['registration']) && $_GET['registration'] === 'success') {
    echo "<p class='success-message'>Rejestracja zakończona sukcesem! Możesz się zalogować.</p>";
}
?>

<div class="container">     
<h2>Logowanie</h2>

<?php
if (!empty($errors)) {
    echo "<ul>"; // Style ul są w CSS
    foreach ($errors as $err) echo "<li>$err</li>";
    echo "</ul>";
}
?>

<form method="POST">
    <label>Login:</label><br>
    <input type="text" name="username" value="testLogin" required><br>

    <label>Hasło:</label><br>
    <input type="password" name="password" value="Test123!" required><br><br>

    <button type="submit">Zaloguj</button>
</form>

<br>
<a href="register.php">Nie masz konta? Zarejestruj się</a>

</div> 
</body>
</html>
