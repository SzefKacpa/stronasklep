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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
        $tytul = $_POST["tytul"];
        $tresc = $_POST["tresc"];

        $stmt = $conn->prepare("UPDATE informacje SET tresc = ? WHERE tytul = ?");
        $stmt->bind_param("ss", $tresc, $tytul);
        if ($stmt->execute()) {
            $message = "Informacje zaktualizowane pomyślnie.";
        } else {
            $message = "Błąd podczas aktualizacji informacji.";
        }
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
        <link rel="stylesheet" href="styl_1.css">
        <title>Zarządzaj Informacjami</title>
    </head>
    <body>
        <h1>Zarządzaj Informacjami</h1>

        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <h2>Aktualizuj Informacje</h2>
        <form method="POST">
            <select name="tytul" required>
                <?php foreach ($informacje as $info): ?>
                    <option value="<?php echo $info['tytul']; ?>"><?php echo $info['tytul']; ?></option>
                <?php endforeach; ?>
            </select>
            <textarea name="tresc" placeholder="Treść" required></textarea>
            <button type="submit" name="update_info">Zaktualizuj</button>
        </form>

        <h2>Obecne Informacje</h2>
        <ul>
            <?php foreach ($informacje as $info): ?>
                <li><strong><?php echo $info['tytul']; ?></strong>: <?php echo $info['tresc']; ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>
