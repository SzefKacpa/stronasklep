<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stronabaza");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$id_klienta = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

$sql = "SELECT k.id, p.nazwa, p.cena, k.ilosc 
        FROM koszyk k
        JOIN produkty p ON k.id_produktu = p.id
        WHERE k.id_klient = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_klienta);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twój Koszyk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="styl_1.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="logo.jpg" alt="Logo Sklepu">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="menu_button nav-link btn btn-outline-light" href="index.php">Strona Główna</a>
                </li>
                <li class="nav-item">
                    <a class="menu_button nav-link btn btn-outline-primary" href="koszyk.php">
                        <i class="bi bi-cart"></i> Koszyk
                    </a>
                </li>
                <?php
                if(!isset($_SESSION["id"])) {
                    echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='logowanie.php'>Zaloguj się</a> </li>";
                    echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='rejestracja.php'>Zarejestruj się</a> </li>";
                } elseif ($_SESSION["id"] != 0) {
                    echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='panel_klienta.php'>Twoje konto</a> </li>";
                } elseif ($_SESSION["id"] == 0) {
                    echo "<li class='nav-item'> <a class='menu_button nav-link btn btn-outline-primary' href='admin.php'>Panel administratora</a> </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center">Twój Koszyk</h1>
    <?php if ($result->num_rows > 0): ?>
        <form method="POST" action="finalizuj_zamowienie.php">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produkt</th>
                        <th>Ilość</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['nazwa']) . "</td>";
                        echo "<td><input type='number' name='ilosc[{$row['id']}]' value='{$row['ilosc']}' min='1' class='form-control'></td>";
                        echo "<td><a href='usun_z_koszyka.php?usun={$row['id']}' class='btn btn-danger btn-sm'>Usuń</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Finalizuj zamówienie</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Kontynuuj zakupy</a>
    <?php else: ?>
        <p class="text-center">Twój koszyk jest pusty.</p>
    <?php endif; ?>
</div>

<footer>
    <div>© 2024 Sklep</div>
    <div>
        <a href="o_nas.php">O nas</a>
        |
        <a href="regulamin.php">Regulamin</a>
    </div>
    <p>Kontakt: <a href="mailto:kontakt@sklep.pl">kontakt@sklep.pl</a> | Telefon: 123-456-789</p>
    <div class="social-icons">
        <div><span>link_facebook</span> <i class="bi bi-facebook"></i></div>
        <div><span>link_instagram</span> <i class="bi bi-instagram"></i></div>
        <div><span>link_tiktok</span> <i class="bi bi-tiktok"></i></div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
