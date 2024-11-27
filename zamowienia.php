<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] != "0") {
    header("Location: logowanie.php?message=Proszę się zalogować jako administrator.");
    exit();
}

$conn = new mysqli("localhost", "root", "", "stronabaza");
if ($conn->connect_error) {
    die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dodaj'])) {
        $id_klient = $_POST['id_klient'];
        $id_produkt = $_POST['id_produkt'];
        $ilosc = $_POST['ilosc'];
        $status  = $_POST['status'];
        $data = $_POST['data'];
        $conn->query("INSERT INTO zamowienia (id_klient, id_produkt, ilosc, status, data) VALUES ('$id_klient', '$id_produkt', '$ilosc', '$status', '$data')");
    } elseif (isset($_POST['usun'])) {
        $id = $_POST['id'];
        $conn->query("DELETE FROM zamowienia WHERE id = '$id'");
    } elseif (isset($_POST['edytuj'])) {
        $id = $_POST['id'];
        $id_klient = $_POST['id_klient'];
        $id_produkt = $_POST['id_produkt'];
        $ilosc = $_POST['ilosc'];
        $status  = $_POST['status'];
        $data = $_POST['data'];
        $conn->query("UPDATE zamowienia SET id_klient = '$id_klient', id_produkt = '$id_produkt', ilosc = '$ilosc', status='$status' data = '$data' WHERE id = '$id'");
    }
}

$zamowienia = [];
$result = $conn->query("SELECT * FROM zamowienia");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $zamowienia[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="styl_2.css" rel="stylesheet">
    <title>Zarządzaj Zamówieniami</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Panel Administracyjny</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="produkty.php">Produkty</a></li>
                <li class="nav-item"><a class="nav-link" href="kategorie.php">Kategorie</a></li>
                <li class="nav-item"><a class="nav-link" href="klienci.php">Klienci</a></li>
                <li class="nav-item"><a class="nav-link active" href="zamowienia.php">Zamówienia</a></li>
                <li class="nav-item"><a class="nav-link" href="informacje.php">Informacje</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Zarządzaj Zamówieniami</h1>

    <h2>Dodaj Zamówienie</h2>
    <form method="post" class="mb-4">
        <div class="mb-3">
            <label for="id_klient" class="form-label">ID Klienta:</label>
            <input type="text" id="id_klient" name="id_klient" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_produkt" class="form-label">ID Produktu:</label>
            <input type="text" id="id_produkt" name="id_produkt" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ilosc" class="form-label">Ilość:</label>
            <input type="number" id="ilosc" name="ilosc" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_produkt" class="form-label">Status:</label>
            <input type="text" id="status" name="status" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data:</label>
            <input type="date" id="data" name="data" class="form-control" required>
        </div>
        <button type="submit" name="dodaj" class="btn btn-primary">Dodaj Zamówienie</button>
    </form>

    <h2>Lista Zamówień</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>ID Zamówienia</th>
            <th>Klient</th>
            <th>Produkt</th>
            <th>Ilość</th>
            <th>Status</th>
            <th>Data</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($zamowienia as $zamowienie): ?>
            <tr>
                <td><?php echo $zamowienie['id']; ?></td>
                <td><?php echo $zamowienie['id_klient']; ?></td>
                <td><?php echo $zamowienie['id_produkt']; ?></td>
                <td><?php echo $zamowienie['ilosc']; ?></td>
                <td><?php echo $zamowienie['status']; ?></td>
                <td><?php echo $zamowienie['data']; ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $zamowienie['id']; ?>">
                        <button type="submit" name="usun" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $zamowienie['id']; ?>">
                        <input type="text" name="id_klient" value="<?php echo $zamowienie['id_klient']; ?>" required>
                        <input type="text" name="id_produkt" value="<?php echo $zamowienie['id_produkt']; ?>" required>
                        <input type="number" name="ilosc" value="<?php echo $zamowienie['ilosc']; ?>" required>
                        <input type="text" name="status" value="<?php echo $zamowienie['status']; ?>" required>
                        <input type="date" name="data" value="<?php echo $zamowienie['data']; ?>" required>
                        <button type="submit" name="edytuj" class="btn btn-warning btn-sm">Edytuj</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
