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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
        $nazwa = $_POST["nazwa"];
        $cena = $_POST["cena"];
        $kategoria = $_POST["kategoria"];

        $stmt = $conn->prepare("INSERT INTO produkty (nazwa, cena, kategoria) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $nazwa, $cena, $kategoria);
        if ($stmt->execute()) {
            $message = "Produkt dodany pomyślnie.";
        } else {
            $message = "Błąd podczas dodawania produktu.";
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
        <link rel="stylesheet" href="styl_1.css">
        <title>Zarządzaj Produktami</title>
    </head>
    <body>
        <h1>Zarządzaj Produktami</h1>
        <form method="POST">
            <input type="text" name="nazwa" placeholder="Nazwa produktu" required>
            <input type="number" step="0.01" name="cena" placeholder="Cena produktu" required>
            <input type="text" name="kategoria" placeholder="Kategoria" required>
            <button type="submit" name="add_product">Dodaj Produkt</button>
        </form>

        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <h2>Lista Produktów</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Cena</th>
                <th>Kategoria</th>
            </tr>
            <?php foreach ($produkty as $produkt): ?>
                <tr>
                    <td><?php echo $produkt['id']; ?></td>
                    <td><?php echo $produkt['nazwa']; ?></td>
                    <td><?php echo $produkt['cena']; ?></td>
                    <td><?php echo $produkt['kategoria']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
