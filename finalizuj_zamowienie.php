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
    foreach ($ilosci as $id_produktu => $ilosc) {
        if ($ilosc > 0) {
            $sql = "SELECT p.nazwa, p.cena FROM produkty p WHERE p.id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_produktu);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $produkty[] = [
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
    <a href="index.php" class="btn btn-primary mt-3">Zakończ zakupy</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
