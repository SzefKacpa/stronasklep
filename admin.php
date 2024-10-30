<?php
    session_start();
    if (!isset($_SESSION["id"]) || $_SESSION["id"] != 0) {
        header("Location: logowanie.php?message=Proszę się zalogować jako administrator.");
        exit();
    }

    $conn = new mysqli("localhost", "root", "", "stronabaza");
    if ($conn->connect_error) {
        die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styl_1.css">
        <title>Panel Administracyjny</title>
    </head>
    <body><center>
        <h1>Panel Administracyjny</h1>
        <nav>
            <ul style="list-style-type: none">
                <li><a href="produkty.php">Zarządzaj Produktami</a></li>
                <li><a href="kategorie.php">Zarządzaj Kategoriami</a></li>
                <li><a href="klienci.php">Zarządzaj Klientami</a></li>
                <li><a href="zamowienia.php">Zarządzaj Zamówieniami</a></li>
                <li><a href="informacje.php">Zarządzaj Informacjami</a></li>
                <li><a href="logout.php">Wyloguj się</a></li>
            </ul>
        </nav>
    </center></body>
</html>