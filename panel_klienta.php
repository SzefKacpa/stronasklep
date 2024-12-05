<?php
session_start();

$mysqli = new mysqli("127.0.0.1", "szefkacpaSQL", "x2J2_6iX$9_#T5", "szefkacpa3");

if ($mysqli->connect_error) {
    die("Błąd połączenia: " . $mysqli->connect_error);
}

$klient_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $hash_haslo=hash('sha256', $_POST['haslo']);
    $adres = $_POST['adres'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $miasto = $_POST['miasto'];
    $telefon = $_POST['telefon'];

    $sql_update = "UPDATE uzytkownicy SET imie = ?, nazwisko = ?, email = ?, haslo = ?, adres = ?, kod_pocztowy = ?, miasto = ?, telefon = ? WHERE id = ?";
    $stmt_update = $mysqli->prepare($sql_update);
    $stmt_update->bind_param("ssssssssi", $imie, $nazwisko, $email, $hash_haslo, $adres, $kod_pocztowy, $miasto, $telefon, $klient_id);

    if ($stmt_update->execute()) {
        echo "<p style='color: green;'>Dane zostały zaktualizowane.</p>";
    } else {
        echo "<p style='color: red;'>Błąd aktualizacji danych: " . $mysqli->error . "</p>";
    }
}

$sql_klient = "SELECT imie, nazwisko, email, adres, kod_pocztowy, miasto, telefon FROM uzytkownicy WHERE id = ?";
$stmt_klient = $mysqli->prepare($sql_klient);
$stmt_klient->bind_param("i", $klient_id);
$stmt_klient->execute();
$dane_klienta = $stmt_klient->get_result()->fetch_assoc();

$sql_zamowienia = "SELECT z.id, p.nazwa, z.ilosc, z.status FROM zamowienia z INNER JOIN produkty p ON z.id_produkt = p.id WHERE z.id_klient = ?";
$stmt_zamowienia = $mysqli->prepare($sql_zamowienia);
$stmt_zamowienia->bind_param("i", $klient_id);
$stmt_zamowienia->execute();
$zamowienia = $stmt_zamowienia->get_result();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep - Strona Główna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="styl_1.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .block {
            width: 48%;
            border: 1px solid #ddd;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
    </style>
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
                    <a class="menu_button nav-link btn btn-outline-success" id="do_logout" href="logout.php">Wyloguj się</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="block">
        <h2>Edycja danych</h2>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <table>
                <tr>
                    <td><label for="imie">Imię:</label></td>
                    <td><input type="text" id="imie" name="imie" value="<?= htmlspecialchars($dane_klienta['imie']) ?>" contenteditable="false"></td>
                </tr>
                <tr>
                    <td><label for="nazwisko">Nazwisko:</label></td>
                    <td><input type="text" id="nazwisko" name="nazwisko" value="<?= htmlspecialchars($dane_klienta['nazwisko']) ?>" contenteditable="false"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" id="email" name="email" value="<?= htmlspecialchars($dane_klienta['email']) ?>" contenteditable="false"></td>
                </tr>
                <tr>
                    <td><label for="haslo">Hasło:</label></td>
                    <td><input type="password" id="haslo" name="haslo" required></td>
                </tr>
                <tr>
                    <td><label for="adres">Adres:</label></td>
                    <td><input type="text" id="adres" name="adres" value="<?= htmlspecialchars($dane_klienta['adres']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="kod_pocztowy">Kod pocztowy:</label></td>
                    <td><input type="text" id="kod_pocztowy" name="kod_pocztowy" value="<?= htmlspecialchars($dane_klienta['kod_pocztowy']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="miasto">Miasto:</label></td>
                    <td><input type="text" id="miasto" name="miasto" value="<?= htmlspecialchars($dane_klienta['miasto']) ?>" required></td>
                </tr>
                <tr>
                    <td><label for="telefon">Telefon:</label></td>
                    <td><input type="text" id="telefon" name="telefon" value="<?= htmlspecialchars($dane_klienta['telefon']) ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Zapisz zmiany</button></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="block">
        <h2>Twoje zamówienia</h2>
        <table>
            <thead>
            <tr>
                <th>Nr zamówienia</th>
                <th>Produkt</th>
                <th>Ilość</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $zamowienia->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['nazwa']) ?></td>
                    <td><?= htmlspecialchars($row['ilosc']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<footer>
    <div>© 2024 Sklep</div>
    <div>
        <a href="o_nas.php">O nas</a>
        |
        <a href="regulamin.php">Regulamin</a></div>
    <p>Kontakt: <a href="mailto:trnshop.kontakt@gmail.com">trnshop.kontakt@gmail.com</a> | Telefon: 123-456-789</p>
    <div class="social-icons">
        <div><span>link_facebook</span> <i class="bi bi-facebook"></i></div>
        <div><span>link_instagram</span> <i class="bi bi-instagram"></i></div>
        <div><span>link_tiktok</span> <i class="bi bi-tiktok"></i></div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('do_logout').onclick = function() {
        window.location.href = 'logout.php';
    };
</script>
</body>
</html>
