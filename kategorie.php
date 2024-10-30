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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_category'])) {
        $nazwa = $_POST["nazwa"];

        $stmt = $conn->prepare("INSERT INTO kategorie (nazwa) VALUES (?)");
        $stmt->bind_param("s", $nazwa);
        if ($stmt->execute()) {
            $message = "Kategoria dodana pomyślnie.";
        } else {
            $message = "Błąd podczas dodawania kategorii.";
        }
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
        <link rel="stylesheet" href="styl_1.css">
        <title>Zarządzaj Kategoriami</title>
    </head>
    <body>
        <h1>Zarządzaj Kategoriami</h1>
        <form method="POST">
            <input type="text" name="nazwa" placeholder="Nazwa kategorii" required>
            <button type="submit" name="add_category">Dodaj Kategorię</button>
        </form>

        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <h2><a href="admin.php">Powrót do panelu administracyjnego</a></h2>

        <h2>Lista Kategorii</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
            </tr>
            <?php foreach ($kategorie as $kategoria): ?>
                <tr>
                    <td><?php echo $kategoria['id']; ?></td>
                    <td><?php echo $kategoria['nazwa']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>