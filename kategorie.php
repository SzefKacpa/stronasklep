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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
    $nazwa = $_POST["nazwa"];
    $stmt = $conn->prepare("INSERT INTO kategorie (nazwa) VALUES (?)");
    $stmt->bind_param("s", $nazwa);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_category'])) {
    $id = $_POST["id"];
    $nazwa = $_POST["nazwa"];
    $stmt = $conn->prepare("UPDATE kategorie SET nazwa = ? WHERE id = ?");
    $stmt->bind_param("si", $nazwa, $id);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_category'])) {
    $id = $_POST["id"];
    $stmt = $conn->prepare("DELETE FROM kategorie WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$kategorie = [];
$result = $conn->query("SELECT * FROM kategorie");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kategorie[] = $row;
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
    <title>Zarządzaj Kategoriami</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Panel Administracyjny</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="produkty.php">Produkty</a></li>
                <li class="nav-item"><a class="nav-link active" href="kategorie.php">Kategorie</a></li>
                <li class="nav-item"><a class="nav-link" href="klienci.php">Klienci</a></li>
                <li class="nav-item"><a class="nav-link" href="zamowienia.php">Zamówienia</a></li>
                <li class="nav-item"><a class="nav-link" href="informacje.php">Informacje</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Zarządzaj Kategoriami</h1>

    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="nazwa" class="form-label">Nazwa kategorii:</label>
            <input type="text" class="form-control" name="nazwa" id="nazwa" required>
        </div>
        <button type="submit" name="add_category" class="btn btn-primary">Dodaj Kategorię</button>
    </form>

    <h2 class="mt-4">Lista Kategorii</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($kategorie as $kategoria): ?>
            <tr>
                <td><?php echo $kategoria['id']; ?></td>
                <td><?php echo $kategoria['nazwa']; ?></td>
                <td>
                    <form method="POST" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $kategoria['id']; ?>">
                        <input type="text" name="nazwa" value="<?php echo $kategoria['nazwa']; ?>" required>
                        <button type="submit" name="edit_category" class="btn btn-warning btn-sm">Edytuj</button>
                    </form>

                    <form method="POST" style="display: inline-block;">
                        <input type="hidden" name="id" value="<?php echo $kategoria['id']; ?>">
                        <button type="submit" name="delete_category" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>

