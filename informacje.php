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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_info'])) {
    $tytul = $_POST["tytul"];
    $tresc = $_POST["tresc"];
    $stmt = $conn->prepare("INSERT INTO informacje (tytul, tresc) VALUES (?, ?)");
    $stmt->bind_param("ss", $tytul, $tresc);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
    $id = $_POST["id"];
    $tytul = $_POST["tytul"];
    $tresc = $_POST["tresc"];
    $stmt = $conn->prepare("UPDATE informacje SET tytul = ?, tresc = ? WHERE id = ?");
    $stmt->bind_param("ssi", $tytul, $tresc, $id);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_info'])) {
    $id = $_POST["id"];
    $stmt = $conn->prepare("DELETE FROM informacje WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$informacje = [];
$result = $conn->query("SELECT * FROM informacje");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $informacje[] = $row;
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
    <title>Zarządzaj Informacjami</title>
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
                <li class="nav-item"><a class="nav-link" href="zamowienia.php">Zamówienia</a></li>
                <li class="nav-item"><a class="nav-link active" href="informacje.php">Informacje</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Zarządzaj Informacjami</h1>

    <form method="POST" class="mb-4">
        <h3>Dodaj nową informację</h3>
        <div class="mb-3">
            <label for="tytul" class="form-label">Tytuł:</label>
            <input type="text" class="form-control" name="tytul" id="tytul" required>
        </div>
        <div class="mb-3">
            <label for="tresc" class="form-label">Treść:</label>
            <textarea class="form-control" name="tresc" id="tresc" rows="3" required></textarea>
        </div>
        <button type="submit" name="add_info" class="btn btn-success">Dodaj Informację</button>
    </form>

    <h2 class="mt-4">Obecne Informacje</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tytuł</th>
            <th>Treść</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($informacje as $info): ?>
            <tr>
                <td><?php echo $info['id']; ?></td>
                <td><?php echo $info['tytul']; ?></td>
                <td><?php echo $info['tresc']; ?></td>
                <td>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <div class="mb-2">
                            <input type="text" name="tytul" value="<?php echo $info['tytul']; ?>" class="form-control mb-2">
                            <textarea name="tresc" rows="2" class="form-control"><?php echo $info['tresc']; ?></textarea>
                        </div>
                        <button type="submit" name="update_info" class="btn btn-primary btn-sm">Edytuj</button>
                    </form>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                        <button type="submit" name="delete_info" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
