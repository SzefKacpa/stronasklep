<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] != "0") {
    header("Location: logowanie.php?message=Proszę się zalogować jako administrator.");
    exit();
}

$conn = new mysqli("127.0.0.1", "szefkacpaSQL", "x2J2_6iX$9_#T5", "szefkacpa3");
if ($conn->connect_error) {
    die("Błąd podczas łączenia z bazą danych: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $nazwa = $_POST["nazwa"];
    $cena = $_POST["cena"];
    $kategoria = $_POST["kategoria"];
    $opis = $_POST["opis"];

    $stmt = $conn->prepare("INSERT INTO produkty (nazwa, cena, id_kategoria, opis) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $nazwa, $cena, $kategoria, $opis);
    if ($stmt->execute()) {
        $message = "Produkt dodany pomyślnie.";
    } else {
        $message = "Błąd podczas dodawania produktu.";
    }
    $stmt->close();
}

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM produkty WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "Produkt usunięty pomyślnie.";
    } else {
        $message = "Błąd podczas usuwania produktu.";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_product'])) {
    $id = $_POST["id"];
    $nazwa = $_POST["nazwa"];
    $cena = $_POST["cena"];
    $kategoria = $_POST["kategoria"];
    $opis = $_POST["opis"];

    $stmt = $conn->prepare("UPDATE produkty SET nazwa = ?, cena = ?, id_kategoria = ?, opis = ? WHERE id = ?");
    $stmt->bind_param("sdssi", $nazwa, $cena, $kategoria, $opis, $id);
    if ($stmt->execute()) {
        $message = "Produkt zaktualizowany pomyślnie.";
    } else {
        $message = "Błąd podczas aktualizacji produktu.";
    }
    $stmt->close();
}

$produkty = [];
$result = $conn->query("SELECT * FROM produkty");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produkty[] = $row;
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
    <title>Zarządzaj Produktami</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Panel Administracyjny</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="produkty.php">Produkty</a></li>
                <li class="nav-item"><a class="nav-link" href="kategorie.php">Kategorie</a></li>
                <li class="nav-item"><a class="nav-link" href="klienci.php">Klienci</a></li>
                <li class="nav-item"><a class="nav-link" href="zamowienia.php">Zamówienia</a></li>
                <li class="nav-item"><a class="nav-link" href="informacje.php">Informacje</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Zarządzaj Produktami</h1>

    <h2 class="mt-4">Dodaj Nowy Produkt</h2>
    <form method="POST" class="mb-4">
        <div class="mb-3">
            <input type="text" name="nazwa" class="form-control" placeholder="Nazwa produktu" required>
        </div>
        <div class="mb-3">
            <input type="number" step="0.01" name="cena" class="form-control" placeholder="Cena produktu" required>
        </div>
        <div class="mb-3">
            <input type="number" name="kategoria" class="form-control" placeholder="ID Kategorii" required>
        </div>
        <div class="mb-3">
            <textarea name="opis" class="form-control" placeholder="Opis produktu"></textarea>
        </div>
        <button type="submit" name="add_product" class="btn btn-primary w-100">Dodaj Produkt</button>
    </form>

    <?php if (!empty($message)) echo "<p class='text-center text-info'>$message</p>"; ?>

    <h2>Lista Produktów</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Kategoria</th>
            <th>Opis</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($produkty as $produkt): ?>
            <tr>
                <td><?php echo $produkt['id']; ?></td>
                <td><?php echo $produkt['nazwa']; ?></td>
                <td><?php echo $produkt['cena']; ?></td>
                <td><?php echo $produkt['id_kategoria']; ?></td>
                <td><?php echo $produkt['opis']; ?></td>
                <td>
                    <a href="?delete_id=<?php echo $produkt['id']; ?>" class="btn btn-danger btn-sm">Usuń</a>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $produkt['id']; ?>">Edytuj</button>

                    <div class="modal fade" id="editModal<?php echo $produkt['id']; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edytuj Produkt</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?php echo $produkt['id']; ?>">
                                        <div class="mb-3">
                                            <input type="text" name="nazwa" class="form-control" value="<?php echo $produkt['nazwa']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" step="0.01" name="cena" class="form-control" value="<?php echo $produkt['cena']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" name="kategoria" class="form-control" value="<?php echo $produkt['id_kategoria']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="opis" class="form-control" required><?php echo $produkt['opis']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                        <button type="submit" name="edit_product" class="btn btn-primary">Zapisz</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
