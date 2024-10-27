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

    $klienci = [];
    $result = $conn->query("SELECT * FROM uzytkownicy");
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
        <link rel="stylesheet" href="styl_1.css">
        <title>Zarządzaj Klientami</title>
    </head>
    <body>
        <h1>Zarządzaj Klientami</h1>

        <h2>Lista Klientów</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Akcje</th>
            </tr>
            <?php foreach ($klienci as $klient): ?>
                <tr>
                    <td><?php echo $klient['id']; ?></td>
                    <td><?php echo $klient['email']; ?></td>
                    <td>
                        <form method="POST" action="usun_klienta.php">
                            <input type="hidden" name="id" value="<?php echo $klient['id']; ?>">
                            <button type="submit">Usuń</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
