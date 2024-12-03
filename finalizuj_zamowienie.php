<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stronabaza");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$id_klienta = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ilosc'])) {
    $ilosci = $_POST['ilosc'];
    $produkty = [];
    foreach ($ilosci as $id_koszyka => $ilosc) {
        if ($ilosc > 0) {
            $sql = "SELECT k.id AS id_koszyka, p.nazwa, p.cena 
                    FROM koszyk k 
                    JOIN produkty p ON k.id_produktu = p.id 
                    WHERE k.id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_koszyka);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $produkty[] = [
                    'id_koszyka' => $row['id_koszyka'],
                    'nazwa' => $row['nazwa'],
                    'cena' => $row['cena'],
                    'ilosc' => $ilosc
                ];
            }
        }
    }
} else {
    header("Location: koszyk.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podsumowanie Zamówienia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px; /* Odstępy między elementami */
            margin: 20px auto;
            width: 50%; /* Szerokość formularza */
        }

        label {
            font-size: 16px;
            text-align: left;
            width: 100%;
        }

        input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            form {
                width: 90%; /* Dostosowanie dla mniejszych ekranów */
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Podsumowanie Zamówienia</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Koszyka</th>
                <th>Produkt</th>
                <th>Ilość</th>
                <th>Cena za sztukę</th>
                <th>Razem</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($produkty as $produkt) {
                $suma = $produkt['cena'] * $produkt['ilosc'];
                echo "<tr>";
                echo "<td>" . htmlspecialchars($produkt['id_koszyka']) . "</td>";
                echo "<td>" . htmlspecialchars($produkt['nazwa']) . "</td>";
                echo "<td>" . htmlspecialchars($produkt['ilosc']) . "</td>";
                echo "<td>" . number_format($produkt['cena'], 2) . " zł</td>";
                echo "<td>" . number_format($suma, 2) . " zł</td>";
                echo "</tr>";
                $total += $suma;
            }
            ?>
        </tbody>
    </table>
    <form method="POST" action="zloz_zamowienie.php">
        <h3>Podaj dane do wysyłki:</h3>
        <label for="imie">Imię:</label>
        <input type="text" name="imie" id="imie" required>
        <label for="nazwisko">Nazwisko:</label>
        <input type="text" name="nazwisko" id="nazwisko" required>
        <label for="adres">Adres:</label>
        <input type="text" name="adres" id="adres" required>
        <label for="miasto">Miasto:</label>
        <input type="text" name="miasto" id="miasto" required>
        <label for="kod_pocztowy">Kod pocztowy:</label>
        <input type="text" name="kod_pocztowy" id="kod_pocztowy" required>
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>
        <label for="telefon">Numer telefonu:</label>
        <input type="text" name="telefon" id="telefon" required>
        <button type="submit">Złóż zamówienie</button>
    </form>

    <h3 class="text-end">Całkowita kwota: <?php echo number_format($total, 2); ?> zł</h3>

    <a href="koszyk.php" class="btn btn-secondary mt-3">Powrót do koszyka</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
