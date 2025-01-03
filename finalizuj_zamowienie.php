<?php
session_start();
$conn = new mysqli("localhost", "root", "", "stronabaza");

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

$id_klienta = isset($_SESSION['id']) ? $_SESSION['id'] : 1;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ilosc'])) {
    $ilosci = $_POST['ilosc'];
    foreach ($ilosci as $id_koszyka => $ilosc) {
        if ($ilosc > 0) {
            $update_sql = "UPDATE koszyk SET ilosc = ? WHERE id = ? AND id_klient = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("iii", $ilosc, $id_koszyka, $id_klienta);
            $update_stmt->execute();
        }
    }
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
    <h3 class="text-end">Całkowita kwota: <?php echo number_format($total, 2); ?> zł</h3>

    <a href="koszyk.php" class="btn btn-secondary mt-3">Powrót do koszyka</a>
    <a href="zloz_zamowienie.php" class="btn btn-primary mt-3">Zakończ zakupy</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
