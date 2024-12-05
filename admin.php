<?php
    session_start();
    if (!isset($_SESSION["id"]) || $_SESSION["id"] != 0) {
        header("Location: logowanie.php?message=Proszę się zalogować jako administrator.");
        exit();
    }

    $conn = new mysqli("127.0.0.1", "szefkacpaSQL", "x2J2_6iX$9_#T5", "szefkacpa3");
    if ($conn->connect_error) {
        die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
    }
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <link href="styl_2.css" rel="stylesheet">
        <title>Panel Administracyjny</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Przełącz nawigację">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="produkty.php">Zarządzaj Produktami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kategorie.php">Zarządzaj Kategoriami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="klienci.php">Zarządzaj Klientami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="zamowienia.php">Zarządzaj Zamówieniami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="informacje.php">Zarządzaj Informacjami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Wyloguj się</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1>Panel Administracyjny</h1>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>
