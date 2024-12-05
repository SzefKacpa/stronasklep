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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add"])) {
        $email = $_POST["email"];
        if (!empty($email)) {
            $stmt = $conn->prepare("INSERT INTO uzytkownicy (email) VALUES (?)");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();
        }
    } elseif (isset($_POST["delete"])) {
        $id = $_POST["id"];
        if (!empty($id)) {
            $stmt = $conn->prepare("DELETE FROM uzytkownicy WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

$klienci = [];
$result = $conn->query("SELECT id, email FROM uzytkownicy");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $klienci[] = $row;
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
    <title>Zarządzaj Klientami</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Panel Administracyjny</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="produkty.php">Produkty</a></li>
                <li class="nav-item"><a class="nav-link" href="kategorie.php">Kategorie</a></li>
                <li class="nav-item"><a class="nav-link active" href="klienci.php">Klienci</a></li>
                <li class="nav-item"><a class="nav-link" href="zamowienia.php">Zamówienia</a></li>
                <li class="nav-item"><a class="nav-link" href="informacje.php">Informacje</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Zarządzaj Klientami</h1>

    <h2 class="mt-4">Dodaj Klienta</h2>
    <form method="post" class="mb-4">
        <div class="input-group">
            <input type="email" name="email" class="form-control" placeholder="Email nowego klienta" required>
            <button type="submit" name="add" class="btn btn-success">Dodaj</button>
        </div>
    </form>

    <h2>Lista Klientów</h2>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Akcje</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($klienci as $klient): ?>
            <tr>
                <td><?php echo $klient['id']; ?></td>
                <td><?php echo $klient['email']; ?></td>
                <td>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $klient['id']; ?>">
                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
